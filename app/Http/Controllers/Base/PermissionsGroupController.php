<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Http\Models\PermissionsGroup;
use App\Http\Models\PermissionsGroupRelation;
use DB;
class PermissionsGroupController extends Controller {
	public function index (Request $request) {
		$limit = $request->input('limit');
		$model = PermissionsGroup::where(function($query)use($request){
			if($request->input('keyword')){
				$query->where('name','like','%'.$request->input('keyword').'%');
			}
			if($request->input('name')){
				$query->where('name','like','%'.$request->input('name').'%');
			}
		})
		->select(['id', 'name', 'created_at']);
		if($limit){
			$datas = $model->paginate($limit);
		}else{
			$datas = $model->get();
		}
		return $datas;
	}
	public function show($id,Request $request) {
		$data = PermissionsGroup::where(['id'=>$id])->first();
		if($data){
			$data->routes = PermissionsGroupRelation::where(['group_id'=>$data->id])->get(['route'])->pluck('route')->all();
			return $data;
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function store (Request $request) {
		$rules = PermissionsGroup::$rules;
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$data = PermissionsGroup::create([
				'name'		=>$request->input('name')
			]);
			if($request->input('routes')){
				$inserts = [];
				foreach($request->input('routes') as $r){
					$inserts[] = [
						'group_id'	=>$data->id,
						'route'		=>$r,
						'created_at'=>DB::raw('now()'),
						'updated_at'=>DB::raw('now()')
					];
				}
				PermissionsGroupRelation::insert($inserts);
			}
			return $data;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function update (Request $request) {
		$rules = PermissionsGroup::$rules;
		$rules['id']='required|exists:permissions_group,id';
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$data = PermissionsGroup::where(['id'=>$request->input('id')])->first();
			$update = [
				'name'		=>$request->input('name')	
			];
			PermissionsGroupRelation::where(['group_id'=>$data->id])->delete();
			if($request->input('routes')){
				$inserts = [];
				foreach($request->input('routes') as $r){
					$inserts[] = [
						'group_id'	=>$data->id,
						'route'		=>$r,
						'created_at'=>DB::raw('now()'),
						'updated_at'=>DB::raw('now()')
					];
				}
				PermissionsGroupRelation::insert($inserts);
			}
			$data->update($update);
			return $data;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function destory (Request $request) {
		$data = PermissionsGroup::where(['id'=>$request->input('id')])->first();
		if($data){
			$data->delete();
			return response(['message'=>trans('messages.delete_successful')]);
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function options(){
		return PermissionsGroup::get(['id as value','name as text']);
	}
}

