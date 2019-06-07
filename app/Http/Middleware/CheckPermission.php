<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use App\Http\Models\RolesAsign;
use App\Http\Models\RolesPermissions;
use App\Http\Models\PermissionsGroupRelation;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $route = Route::current();
        $user = auth()->user();
        // 判断路由是否需要权限校验
        if(isset($route->action['cp']) && $route->action['cp'] && $user->id != 1){
            // 获取用户权限
            $permissions = [];
            $roles = RolesAsign::where(['asign_to'=>$user->id])->get(['role_id'])->pluck('role_id')->all();
            $p1 = RolesPermissions::whereIn('role_id',$roles)->whereNotNull('route')->get(['route'])->pluck('route')->all();
            $p2 = RolesPermissions::leftjoin('permissions_group_relation as pgr','pgr.group_id','=','roles_permissions.group_id')->whereIn('roles_permissions.role_id',$roles)->whereNotNull('roles_permissions.group_id')->get(['pgr.route'])->pluck('route')->all();
            $up = array_merge($p1,$p2);
            // 检索当前权限
            if(!in_array($route->action['as'],$up)){
                return response(['message'=>'messages.no_permission'],403);
            }
        }
        return $next($request);
    }
}
