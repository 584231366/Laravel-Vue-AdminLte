<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Http\Models\Users;
use App\Http\Models\RolesAsign;
use DB;

class UsersController extends Controller {
	public function index (Request $request) {
		$limit = $request->input('limit');
		$model = Users::where(function($query)use($request){
			if($request->input('keyword')){
				$query->where('name','like','%'.$request->input('keyword').'%');
				$query->where('email','like','%'.$request->input('keyword').'%');
				$query->where('mobile','like','%'.$request->input('keyword').'%');
			}
			if($request->input('name')){
				$query->where('name','like','%'.$request->input('name').'%');
			}
			if($request->input('email')){
				$query->where('email','like','%'.$request->input('name').'%');
			}
			if($request->input('mobile')){
				$query->where('mobile','like','%'.$request->input('name').'%');
			}
		})
		->select(['id','name','email','mobile','created_at']);
		if($limit){
			$users = $model->paginate($limit);
		}else{
			$users = $model->get();
		}
		return $users;
	}
	public function show($id,Request $request) {
		$user = Users::where(['id'=>$id])->first();
		if($user){
			$user->roles = RolesAsign::where(['asign_to'=>$user->id])->get(['role_id'])->pluck('role_id')->all();
			return $user;
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function store (Request $request) {
		$rules = Users::$rules;
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$user = Users::create([
				'name'		=>$request->input('name'),
				'email'		=>$request->input('email'),
				'mobile'	=>$request->input('mobile'),
				'password'	=>bcrypt($request->input('password'))
			]);
			if($request->input('roles')){
				$inserts = [];
				foreach($request->input('roles') as $rid){
					$inserts[] = [
						'role_id'	=>$rid,
						'asign_to'	=>$user->id,
						'created_at'=>DB::raw('now()'),
						'updated_at'=>DB::raw('now()')
					];
				}
				RolesAsign::insert($inserts);
			}
			return $user;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function update (Request $request) {
		if($request->input('password')){
			$rules = Users::$rules;
		}else{
			$rules = [
				'name'		=>Users::$rules['name'],
				'email'		=>Users::$rules['email'].','.$request->input('id').',id',
				'mobile'	=>Users::$rules['mobile'].','.$request->input('id').',id',
			];
		}
		$rules['id']='required|exists:users,id';
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$user = Users::where(['id'=>$request->input('id')])->first();
			$update = [
				'name'		=>$request->input('name'),
				'email'		=>$request->input('email'),
				'mobile'	=>$request->input('mobile'),			
			];
			if($request->input('password')){
				$update['password'] = bcrypt($request->input('password'));
			}
			RolesAsign::where(['asign_to'=>$user->id])->delete();
			if($request->input('roles')){
				$inserts = [];
				foreach($request->input('roles') as $rid){
					$inserts[] = [
						'role_id'	=>$rid,
						'asign_to'	=>$user->id,
						'created_at'=>DB::raw('now()'),
						'updated_at'=>DB::raw('now()')
					];
				}
				RolesAsign::insert($inserts);
			}
			$user->update($update);
			return $user;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function destory (Request $request) {
		$user = Users::where(['id'=>$request->input('id')])->first();
		if($user){
			$user->delete();
			return response(['message'=>trans('messages.delete_successful')]);
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
}

