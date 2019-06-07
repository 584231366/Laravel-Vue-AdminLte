<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('菜单名称');
            $table->string('icon')->comment('菜单图标');
            $table->string('route')->comment('vue路由');
            $table->integer('display')->default(0)->comment('排序');
            $table->integer('pre_id')->nullable()->comment('父菜单编号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
