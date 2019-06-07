<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsGroupRelation extends Model
{
    protected $table = 'permissions_group_relation';

    protected $fillable = [
        'group_id', ' route'
    ];

    public static $rules = [
        'group_id'   =>'required',
        'route'   =>'required'
    ];
}
