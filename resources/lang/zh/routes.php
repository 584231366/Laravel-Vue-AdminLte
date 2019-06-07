<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 路由对照名称
    |--------------------------------------------------------------------------
    |
    */
    'api'=>[
		'routes' => [
	        'options'=> '路由复选框选项接口'
	    ],
	    'users' => [
	        'index'		=> '用户批量获取接口',
	        'store'		=> '用户创建接口',
	        'update'	=> '用户更新接口',
	        'show'		=> '指定用户获取接口',
	        'destory'	=> '用户删除接口'
	    ],
	    'menus' => [
	        'index'		=> '菜单批量获取接口',
	        'store'		=> '菜单创建接口',
	        'update'	=> '菜单更新接口',
	        'show'		=> '指定菜单获取接口',
	        'destory'	=> '菜单删除接口',
	        'options'	=> '菜单下拉数据接口',
	        'umenus'	=> '用户关联菜单获取接口'
	    ],
	    'roles' => [
	        'index'		=> '角色批量获取接口',
	        'store'		=> '角色创建接口',
	        'update'	=> '角色更新接口',
	        'show'		=> '指定角色获取接口',
	        'destory'	=> '角色删除接口',
	        'options'	=> '角色复选数据接口'
	    ],
	    'permissionsgroup' => [
	        'index'		=> '权限组批量获取接口',
	        'store'		=> '权限组创建接口',
	        'update'	=> '权限组更新接口',
	        'show'		=> '指定权限组获取接口',
	        'destory'	=> '权限组删除接口',
	        'options'	=> '权限组复选数据接口'
	    ]
    ]
];
