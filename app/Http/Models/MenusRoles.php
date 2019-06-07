<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MenusRoles extends Model
{
    protected $table = 'menus_roles';

    protected $fillable = [
        'role_id', 'menu_id'
    ];

    public static $rules = [
        'role_id'         =>'required',
        'menu_id'         =>'required',
    ];
}
