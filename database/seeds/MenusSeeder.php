<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Menus;
use Illuminate\Support\Facades\DB;
class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menus::insert([
        	['name'=>'系统管理','icon'=>'fa  fa-cog','route'=>'/','display'=>10,'pre_id'=>null,'created_at'=>DB::raw('NOW()'),'updated_at'=>DB::raw('NOW()')],
        	['name'=>'用户管理','icon'=>'fa fa-circle-o','route'=>'/admin/users','display'=>0,'pre_id'=>1,'created_at'=>DB::raw('NOW()'),'updated_at'=>DB::raw('NOW()')],
        	['name'=>'角色管理','icon'=>'fa fa-circle-o','route'=>'/admin/roles','display'=>0,'pre_id'=>1,'created_at'=>DB::raw('NOW()'),'updated_at'=>DB::raw('NOW()')],
        	['name'=>'权限组管理','icon'=>'fa fa-circle-o','route'=>'/admin/permissionsgroup','display'=>0,'pre_id'=>1,'created_at'=>DB::raw('NOW()'),'updated_at'=>DB::raw('NOW()')],
        	['name'=>'菜单管理','icon'=>'fa fa-circle-o','route'=>'/admin/menus','display'=>0,'pre_id'=>1,'created_at'=>DB::raw('NOW()'),'updated_at'=>DB::raw('NOW()')],
        ]);
    }
}
