<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModule extends Model
{
    use HasFactory;

    protected $table = 'service_modules';

    public $timestamps = false;

    protected $fillable = [
        'service_id',
        'module_id'
    ];
}
