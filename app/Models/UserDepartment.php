<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;

    protected $table = 'user_departments';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'department_id'
    ];
}
