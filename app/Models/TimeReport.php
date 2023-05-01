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

    /**
     * @param  int $workplace_id
     * @return JsonResponse
     */
    public static function createRecord(int $workplace_id): JsonResponse
    {
        $result = TimeReport::create([
            'user_id'      => Auth::id(),
            'date'         => date('Y-m-d'),
            'time_start'   => date('H:i:s'),
            'workplace_id' => $workplace_id
        ]);

        if ($result) {
            $json['success'] = 'You are successfully started working day';
        } else {
            $json['error'] = 'Failed to start working day';
        }
        return response()->json($json);
    }

    /**
     * @param  Collection $day_info
     * @param  float $total_timebreak
     * @param  float $total
     * @return JsonResponse
     */
    public static function setTotal(Collection $day_info, float $total_timebreak, float $total): JsonResponse
    {
        $result = TimeReport::where(['id' => $day_info[0]->id])
                ->update([
                    'time_end'        => date('H:i:s'),
                    'total_timebreak' => $total_timebreak,
                    'total'           => $total
                ]);

        if ($result) {
            $json['success'] = 'You are successfully ended working day';
        } else {
            $json['error'] = 'Failed to end working day';
        }

        return response()->json($json);
    }

    public static function currentDayInfo() : Collection
    {
        return TimeReport::where([
            'user_id' => Auth::id(),
            'date'    => date('Y-m-d')
        ])
            ->get();
    }

    public static function getPersonalReport() : Collection
    {
        return TimeReport::where([
            'user_id' => Auth::id()
        ])
            ->join('users', 'time_reports.user_id', '=', 'users.id', 'left')
            ->whereMonth('date' , Carbon::now()->month)
            ->get();
    }
}
