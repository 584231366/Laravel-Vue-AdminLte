<?php
namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use RoutesService;

class RoutesController extends Controller{
	/**
	 * 路由选项
	 * @return [type] [description]
	 *
	 * author 唐茄茄
	 */
	public function options(){
		$routes = RoutesService::getRoutesByParam('cp');
		$options = [];
		foreach($routes as $r){
			if(isset($r['cp']) && $r['cp']){
				$options[] = [
					'value'=> $r['as'],
					'text' => trans('routes.'.$r['as'])
				];
			}
		}
		return $options;
	}
}