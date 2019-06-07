<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RolesPermissions extends Model
{
    protected $table = 'roles_permissions';

    protected $fillable = [
        'role_id', 'route', 'group_id'
    ];

    public static $rules = [
        'role_id'   =>'required'
    ];
}
