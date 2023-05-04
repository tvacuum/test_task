<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSchedule extends Model
{
    use HasFactory;

    protected $table = 'user_schedules';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'schedule_id'
    ];

    public static function getUserSchedule(): UserSchedule
    {
        return UserSchedule::where([
            'user_id' => Auth::id()
        ])
            ->join('schedules', 'user_schedules.schedule_id', '=', 'schedules.id', 'left')
            ->first();
    }
}
