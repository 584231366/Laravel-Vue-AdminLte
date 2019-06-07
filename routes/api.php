<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|	cp属性： true需要权限校验 false无需权限校验
|
*/
Route::group(['prefix'=>'/v1'],function(){ 
	Route::post('/login',['as'=>'api.guest.loginapi','uses'=>'Auth\LoginController@loginApi']);
	Route::group(['middleware'=>['auth:api'],'prefix'=>'/'],function(){
		// 用户基础接口
		Route::group(['prefix'=>'/user'],function(){
			Route::get('/',['as'=>'api.user.userinfo','uses'=>'Base\UserController@userinfo']);
			Route::put('/resetpassword',['as'=>'api.user.resetpassword','uses'=>'Base\UserController@resetpassword']);
		});
		Route::get('routes/options',['as'=>'api.routes.options','uses'=>'Base\\RoutesController@options']);
		// 用户管理路由
		Route::group(['prefix'=>'/users'],function(){
			Route::get('/',['as'=>'api.users.index','uses'=>'Base\UsersController@index','cp'=>true]);
			Route::get('/{id}',['as'=>'api.users.show','uses'=>'Base\UsersController@show','cp'=>true])->where('id','[0-9]*');
			Route::post('/',['as'=>'api.users.store','uses'=>'Base\UsersController@store','cp'=>true]);
			Route::put('/',['as'=>'api.users.update','uses'=>'Base\UsersController@update','cp'=>true]);
			Route::delete('/',['as'=>'api.users.destory','uses'=>'Base\UsersController@destory','cp'=>true]);
		});
		// 菜单管理路由
		Route::group(['prefix'=>'/menus'],function(){
			Route::get('/',['as'=>'api.menus.index','uses'=>'Base\MenusController@index','cp'=>true]);
			Route::get('/{id}',['as'=>'api.menus.show','uses'=>'Base\MenusController@show','cp'=>true])->where('id','[0-9]*');
			Route::post('/',['as'=>'api.menus.store','uses'=>'Base\MenusController@store','cp'=>true]);
			Route::put('/',['as'=>'api.menus.update','uses'=>'Base\MenusController@update','cp'=>true]);
			Route::delete('/',['as'=>'api.menus.destory','uses'=>'Base\MenusController@destory','cp'=>true]);
			Route::get('/options',['as'=>'api.menus.options','uses'=>'Base\MenusController@options','cp'=>true]);
			Route::get('/umenus',['as'=>'api.menus.umenus','uses'=>'Base\MenusController@umenus']);
		});
		// 角色管理路由
		Route::group(['prefix'=>'/roles'],function(){
			Route::get('/',['as'=>'api.roles.index','uses'=>'Base\RolesController@index','cp'=>true]);
			Route::get('/{id}',['as'=>'api.roles.show','uses'=>'Base\RolesController@show','cp'=>true])->where('id','[0-9]*');
			Route::post('/',['as'=>'api.roles.store','uses'=>'Base\RolesController@store','cp'=>true]);
			Route::put('/',['as'=>'api.roles.update','uses'=>'Base\RolesController@update','cp'=>true]);
			Route::delete('/',['as'=>'api.roles.destory','uses'=>'Base\RolesController@destory','cp'=>true]);
			Route::get('/options',['as'=>'api.roles.options','uses'=>'Base\RolesController@options','cp'=>true]);
		});
		// 权限组管理路由
		Route::group(['prefix'=>'/permissionsgroup'],function(){
			Route::get('/',['as'=>'api.permissionsgroup.index','uses'=>'Base\PermissionsGroupController@index','cp'=>true]);
			Route::get('/{id}',['as'=>'api.permissionsgroup.show','uses'=>'Base\PermissionsGroupController@show','cp'=>true])->where('id','[0-9]*');
			Route::post('/',['as'=>'api.permissionsgroup.store','uses'=>'Base\PermissionsGroupController@store','cp'=>true]);
			Route::put('/',['as'=>'api.permissionsgroup.update','uses'=>'Base\PermissionsGroupController@update','cp'=>true]);
			Route::delete('/',['as'=>'api.permissionsgroup.destory','uses'=>'Base\PermissionsGroupController@destory','cp'=>true]);
			Route::get('/options',['as'=>'api.permissionsgroup.options','uses'=>'Base\PermissionsGroupController@options','cp'=>true]);
		});
	});
});