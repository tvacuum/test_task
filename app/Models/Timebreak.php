<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Timebreak extends Model
{
    use HasFactory;

    protected $table = 'timebreaks';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'day_id',
        'workplace_id',
        'time_leave',
        'time_comeback'
    ];

    public static function createRecord($day_info)
    {
        $result = Timebreak::create([
            'day_id'       => $day_info[0]->id,
            'workplace_id' => $day_info[0]->workplace_id,
            'time_leave'   => date('H:i:s'),
        ]);

        if ($result) {
            $json['success'] = 'You are successfully paused working day';
        } else {
            $json['error'] = 'Failed to pause the day';
        }
        return response()->json($json);
    }

    public static function setTimeComeback($day_info)
    {
        $result = Timebreak::where([
            'day_id' => $day_info[0]->id,
        ])
            ->latest('id')
            ->first()
            ->update([
                'time_comeback' => date('H:i:s'),
            ]);

        if ($result) {
            $json['success'] = 'You are successfully resumed working day';
        } else {
            $json['error'] = 'Failed to resume working day';
        }
        return response()->json($json);
    }
}
