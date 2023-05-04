<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;

class PauseDayAction
{
    /**
     * Pause current working day for Authenticated user
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $time = Carbon::now();

        $data = [
            'day_id'             => $day_info->id,
            'leave_workplace_id' => $day_info->workplace_id,
            'time_leave'         => $time->toTimeString()
        ];

        if (Timebreak::create($data)) {
            $json['success'] = 'You are successfully paused working day';
        } else {
            $json['error'] = 'Failed to pause the day';
        }
        return response()->json($json);
    }
}
