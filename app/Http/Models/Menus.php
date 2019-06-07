<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name', 'icon', 'route', 'display','pre_id'
    ];

    public static $rules = [
        'name'         =>'required',
        'icon'         =>'required',
        'display'	   =>'numeric'
    ];
}
