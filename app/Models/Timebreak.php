<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Timebreak extends Model
{
    use HasFactory;

    protected $table = 'timebreaks';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'day_id',
        'leave_workplace_id',
        'comeback_workplace_id',
        'time_leave',
        'time_comeback'
    ];

    public static function getLastTimebreak($day_id): Timebreak | null
    {
        return Timebreak::where([
            'day_id' => $day_id
        ])
            ->latest('id')
            ->first();
    }
}
