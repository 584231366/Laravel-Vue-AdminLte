<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Http\Models\Roles;
use App\Http\Models\RolesPermissions;
use DB;
class RolesController extends Controller {
	public function index (Request $request) {
		$limit = $request->input('limit');
		$model = Roles::where(function($query)use($request){
			if($request->input('keyword')){
				$query->where('name','like','%'.$request->input('keyword').'%');
				$query->where('desc','like','%'.$request->input('keyword').'%');
				$query->where('tag','like','%'.$request->input('keyword').'%');
			}
			if($request->input('name')){
				$query->where('name','like','%'.$request->input('name').'%');
			}
			if($request->input('desc')){
				$query->where('desc','like','%'.$request->input('desc').'%');
			}
			if($request->input('tag')){
				$query->where('tag','like','%'.$request->input('tag').'%');
			}
		})
		->select(['id', 'name', 'desc', 'tag', 'created_at']);
		if($limit){
			$roles = $model->paginate($limit);
		}else{
			$roles = $model->get();
		}
		return $roles;
	}
	public function show($id,Request $request) {
		$role = Roles::where(['id'=>$id])->first();
		if($role){
			$role->routes = RolesPermissions::where(['role_id'=>$role->id])->whereNotNull('route')->get(['route'])->pluck('route')->all();
			$role->groups = RolesPermissions::where(['role_id'=>$role->id])->whereNotNull('group_id')->get(['group_id'])->pluck('group_id')->all();
			return $role;
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function store (Request $request) {
		$rules = Roles::$rules;
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$role = Roles::create([
				'name'		=>$request->input('name'),
				'desc'		=>$request->input('desc'),
				'tag'		=>$request->input('tag')
			]);
			if($request->input('groups') || $request->input('routes')){
				$inserts = [];
				if($request->input('groups')){
					foreach($request->input('groups') as $gid){
						$inserts[] = [
							'role_id'	=>$role->id,
							'route'		=> null,
							'group_id'	=>$gid,
							'created_at'=>DB::raw('now()'),
							'updated_at'=>DB::raw('now()')
						];
					}
				}
				if($request->input('routes')){
					foreach($request->input('routes') as $r){
						$inserts[] = [
							'role_id'	=>$role->id,
							'route'		=>$r,
							'group_id'	=>null,
							'created_at'=>DB::raw('now()'),
							'updated_at'=>DB::raw('now()')
						];
					}
				}
				RolesPermissions::insert($inserts);
			}
			return $role;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function update (Request $request) {
		$rules = Roles::$rules;
		$rules['id']='required|exists:roles,id';
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$role = Roles::where(['id'=>$request->input('id')])->first();
			$update = [
				'name'		=>$request->input('name'),
				'desc'		=>$request->input('desc'),
				'tag'		=>$request->input('tag')		
			];
			$role->update($update);
			RolesPermissions::where(['role_id'=>$role->id])->delete();
			if($request->input('groups') || $request->input('routes')){
				$inserts = [];
				if($request->input('groups')){
					foreach($request->input('groups') as $gid){
						$inserts[] = [
							'role_id'	=>$role->id,
							'route'		=> null,
							'group_id'	=>$gid,
							'created_at'=>DB::raw('now()'),
							'updated_at'=>DB::raw('now()')
						];
					}
				}
				if($request->input('routes')){
					foreach($request->input('routes') as $r){
						$inserts[] = [
							'role_id'	=>$role->id,
							'route'		=>$r,
							'group_id'	=>null,
							'created_at'=>DB::raw('now()'),
							'updated_at'=>DB::raw('now()')
						];
					}
				}
				RolesPermissions::insert($inserts);
			}
			return $role;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function destory (Request $request) {
		$role = Roles::where(['id'=>$request->input('id')])->first();
		if($role){
			$role->delete();
			return response(['message'=>trans('messages.delete_successful')]);
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function options(){
		return Roles::get(['id as value','name as text']);
	}
}

