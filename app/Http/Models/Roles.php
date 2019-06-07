<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'desc', 'tag'
    ];

    public static $rules = [
        'name'   =>'required'
    ];
}
