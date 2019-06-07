<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsGroup extends Model
{
    protected $table = 'permissions_group';

    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name'   =>'required',
        'routes' =>'array'
    ];
}
