<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Http\Models\Menus;
use App\Http\Models\MenusRoles;
use DB;
class MenusController extends Controller {
	public function index (Request $request) {
		$limit = $request->input('limit');
		$model = Menus::where(function($query)use($request){
			if($request->input('keyword')){
				$query->where('name','like','%'.$request->input('keyword').'%');
			}
			if($request->input('name')){
				$query->where('name','like','%'.$request->input('name').'%');
			}
		})
		->orderByRaw('pre_id,display asc')
		->select(['id', 'name', 'icon', 'route', 'display','pre_id', 'created_at']);
		if($limit){
			$menus = $model->paginate($limit);
		}else{
			$menus = $model->get();
		}
		foreach ($menus as $item) {
			$item->show_name = $this->showName($item->id);
		}
		return $menus;
	}
	public function show($id,Request $request) {
		$menu = Menus::where(['id'=>$id])->first();
		if($menu){
			$menu->roles = MenusRoles::where(['menu_id'=>$menu->id])->get('id')->pluck('id')->all();
			return $menu;
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function store (Request $request) {
		$rules = Menus::$rules;
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$menu = Menus::create([
				'name'		=>$request->input('name'),
				'icon'		=>$request->input('icon'),
				'route'		=>$request->input('route'),
				'display'	=>$request->input('display'),
				'pre_id'	=>$request->input('pre_id')
			]);
			
			if($request->input('roles')){
				$inserts = [];
				foreach($request->input('roles') as $rid){
					$inserts[] = [
						'role_id'	=> $rid,
						'menu_id'	=> $menu->id,
						'created_at'=>DB::raw('now()'),
						'updated_at'=>DB::raw('now()')
					];
				}
				MenusRoles::insert($inserts);
			}
			return $menu;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function update (Request $request) {
		$rules = Menus::$rules;
		$rules['id']='required|exists:menus,id';
		$check = validator($request->all(),$rules);
		if($check->passes()){
			$menu = Menus::where(['id'=>$request->input('id')])->first();
			$update = [
				'name'		=>$request->input('name'),
				'icon'		=>$request->input('icon'),
				'route'		=>$request->input('route'),
				'display'	=>$request->input('display'),
				'pre_id'	=>$request->input('pre_id')			
			];
			$menu->update($update);
			MenusRoles::where(['menu_id'=>$menu->id])->delete();
			if($request->input('roles')){
				$inserts = [];
				foreach($request->input('roles') as $rid){
					$inserts[] = [
						'role_id'	=> $rid,
						'menu_id'	=> $menu->id,
						'created_at'=>DB::raw('now()'),
						'updated_at'=>DB::raw('now()')
					];
				}
				MenusRoles::insert($inserts);
			}
			return $menu;
		}else{
			return response(['message'=>trans('messages.check_form_please'),'errors'=>$check->errors()],400);
		}
	}
	public function destory (Request $request) {
		$menu = Menus::where(['id'=>$request->input('id')])->first();
		if($menu){
			$menu->delete();
			return response(['message'=>trans('messages.delete_successful')]);
		}else{
			return response(['message'=>trans('messages.data_is_unexist')],400);
		}
	}
	public function options(){
		return Menus::get(['id as value','name as text']);
	}
	/**
	 * 用户关联菜单
	 * @return [type] [description]
	 */
	public function umenus(){
		$menus = Menus::leftJoin('menus as bm','bm.pre_id','=','menus.id')
			->where(function($query){
				if(auth()->user()->id!=1){ // 特殊角色不做过滤
					$query->whereIn('menus.id',function($query){
						$query->select('menu_id')->from('menus_roles')
							->leftjoin('roles_asign','roles_asign.role_id','=','menus_roles.role_id')
							->where(['roles_asign.asign_to'=>auth()->user()->id]);
					});
				}
			})
			->groupBy('menus.id')
			->orderByRaw('menus.pre_id,menus.display asc')
			->get([
				'menus.*',
				DB::raw('count(bm.id) as children')
			]);
		return $menus;
	}
	/**
	 * 填充菜单名称
	 * @param unknown $id
	 * @param unknown $menus
	 */
	private function showName($id,$menus=null){
		if ($menus){
			if ($id) {
				$mn = $this->showName($menus[$id]['pre_id'],$menus);
				if ($mn) {
					return $this->showName($menus[$id]['pre_id'],$menus).'>'.$menus[$id]['name'];
				}
				return $menus[$id]['name'];
			}else{
				return '';
			}
		}else{
			$menus = Menus::get(['id','name','pre_id'])->keyBy('id')->all();
			return $this->showName($id,$menus);
		}
	}
}

