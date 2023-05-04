<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    use HasFactory;

    protected $table = 'user_positions';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'position_id'
    ];
}
