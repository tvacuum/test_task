<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentPosition extends Model
{
    use HasFactory;

    protected $table = 'department_positions';

    public $timestamps = false;

    protected $fillable = [
        'department_id',
        'position_id'
    ];
}
