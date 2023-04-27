<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'password',
        'birthday',
        'quote',
        'photo',
        'telegram_id'
    ];

    protected $hidden = [
      'password',
      'email',
      'phone'
    ];
}
