<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Time;

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

    public static function createRecord($workplace_id)
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

    public static function currentDayInfo()
    {
        return TimeReport::where([
            'user_id' => Auth::id(),
            'date'    => date('Y-m-d')
        ])->get();
    }

    public static function setTotal($day_info, $total_timebreak, $total)
    {
        return TimeReport::where(['id' => $day_info[0]->id])
                ->update([
                    'time_end' => date('H:i:s'),
                    'total_timebreak' => $total_timebreak,
                    'total' => $total
                ]);
    }
}