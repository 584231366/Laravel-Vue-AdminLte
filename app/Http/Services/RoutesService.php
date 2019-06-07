<?php
namespace App\Http\Services;

use Illuminate\Routing\Router;

class RoutesService
{
	protected $router;
	protected $routes;
	public function __construct(Router $router){
		$this->router = $router;
		$this->routes = $router->getRoutes();
	}
	/**
	 * 获取所有路由信息
	 */
	public function getRoutes(){
		$RouteTable = [];
		foreach ($this->routes as $key=>$route) {
			$RouteTable[] = collect([])
			  	->merge(['uri'=>$route->uri])
				->merge(['methods'=>$route->methods])
				->merge($route->action)->all();
		}
		return $RouteTable;
	}
	/**
	 * 获取包含指定参数的路由信息
	 * @param string $pk
	 */
	public function getRoutesByParam($pk){
		return collect($this->getRoutes())->filter(function($route,$key)use($pk){
			return isset($route[$pk])?true:false;
		})->all();
	}
	/**
	 * 获取所有路由指定参数的集合
	 * @param string $pk
	 */
	public function getParamCollection($pk){
		$arr =collect([]);
		foreach ($this->getRoutes() as $route) {
			if(isset($route[$pk])){
				if (is_array($route[$pk])) {
					foreach ($route[$pk] as $v) {
						$arr->push($v);
					}
				}else{
					$arr->push($route[$pk]);
				}
			}
		}
		return $arr->unique()->all();
	}
}