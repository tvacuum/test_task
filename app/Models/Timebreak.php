<?php

namespace App\Models;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * @param  Collection $day_info
     * @return JsonResponse
     */
    public static function createRecord(Collection $day_info): JsonResponse
    {
        $result = Timebreak::create([
            'day_id'       => $day_info[0]->id,
            'workplace_id' => $day_info[0]->workplace_id,
            'time_leave'   => Carbon::createFromFormat('H:i:s', Carbon::now())
        ]);

        if ($result) {
            $json['success'] = 'You are successfully paused working day';
        } else {
            $json['error'] = 'Failed to pause the day';
        }
        return response()->json($json);
    }

    /**
     * @param  Collection $day_info
     * @return JsonResponse
     */
    public static function setTimeComeback(Collection $day_info): JsonResponse
    {
        $result = Timebreak::where([
            'day_id' => $day_info[0]->id,
        ])
            ->latest('id')
            ->first()
            ->update([
                'time_comeback' => Carbon::createFromFormat('H:i:s', Carbon::now()),
            ]);

        if ($result) {
            $json['success'] = 'You are successfully resumed working day';
        } else {
            $json['error'] = 'Failed to resume working day';
        }
        return response()->json($json);
    }
}
