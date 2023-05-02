<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;

class PauseDayAction
{
    public function __invoke(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $time = Carbon::now();

        $data = [
            'day_id'       => $day_info[0]->id,
            'workplace_id' => $day_info[0]->workplace_id,
            'time_leave'   => $time->toTimeString()
        ];

        if (Timebreak::create($data)) {
            $json['success'] = 'You are successfully paused working day';
        } else {
            $json['error'] = 'Failed to pause the day';
        }
        return response()->json($json);
    }
}
