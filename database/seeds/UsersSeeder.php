<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Users;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
        	'name'=>'最高管理',
        	'email'=>'584231366@qq.com',
        	'mobile'=>'13799956353',
        	'password'=>bcrypt('123456')
        ]);
    }
}
