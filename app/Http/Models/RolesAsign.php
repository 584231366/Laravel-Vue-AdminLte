<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RolesAsign extends Model
{
    protected $table = 'roles_asign';

    protected $fillable = [
        'role_id', 'asign_to'
    ];

    public static $rules = [
        'role_id'   =>'required',
        'asign_to'   =>'required'
    ];
}
