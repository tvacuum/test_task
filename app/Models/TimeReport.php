<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeReport extends Model
{
    use HasFactory;

    protected $table = 'time_reports';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'date',
        'time_start',
        'time_end',
        'total_timebreak',
        'total',
        'without_lunch',
        'forgot_flag',
        'comment',
        'workplace_id'
    ];
    public static function currentDayInfo(): TimeReport | null
    {
        return TimeReport::where([
            'user_id' => Auth::id(),
            'date'    => date('Y-m-d')
        ])
            ->first();
    }

    public static function lastDayInfo(): TimeReport | null
    {
        return TimeReport::where([
            'user_id' => Auth::id()
        ])
            ->latest('date')
            ->first();
    }

    public static function getPersonalReport(): Collection | null
    {
        return TimeReport::where([
            'user_id' => Auth::id()
        ])
            ->join('users', 'time_reports.user_id', '=', 'users.id', 'left')
            ->whereMonth('date', Carbon::now()->month)
            ->get();
    }

    public static function getTotalReport(): Collection | null
    {
        return TimeReport::select('time_reports.*', 'users.firstname', 'users.lastname', 'workplaces.name')
            ->join('workplaces', 'time_reports.workplace_id', '=', 'workplaces.id')
            ->join('users', 'time_reports.user_id', '=', 'users.id', 'left')
            ->whereMonth('time_reports.date', Carbon::now()->month)
            ->orderBy('time_reports.user_id')->orderBy('time_reports.date')
            ->get();
    }
}
