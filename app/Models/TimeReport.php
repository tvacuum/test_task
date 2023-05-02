<?php

namespace App\Models;

use Illuminate\Http\JsonResponse;
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
        'comment',
        'workplace_id'
    ];
    public static function currentDayInfo(): Collection
    {
        return TimeReport::where([
            'user_id' => Auth::id(),
            'date'    => date('Y-m-d')
        ])
            ->get();
    }

    public static function getPersonalReport(): Collection
    {
        return TimeReport::where([
            'user_id' => Auth::id()
        ])
            ->join('users', 'time_reports.user_id', '=', 'users.id', 'left')
            ->whereMonth('date' , Carbon::now()->month)
            ->get();
    }
}
