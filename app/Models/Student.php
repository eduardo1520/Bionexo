<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    protected $fillable = [
        'name',
        'amount'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
