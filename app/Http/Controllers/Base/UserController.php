<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Http\Models\Users;
use DB;

class UserController extends Controller {
	/**
	 * 密码重置
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function resetPassword (Request $request) {
		$rules['password'] = Users::$rules['password'];
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$user = Users::where(['id'=>auth()->user()->id])->first();
			$user->update(['password'=>bcrypt($request->input('password'))]);
			return $user;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	/**
	 * 登录用户基础信息获取
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function userinfo(Request $request){
		return auth()->user();
	}
}

