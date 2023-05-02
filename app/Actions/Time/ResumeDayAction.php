<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;

class ResumeDayAction
{
    public function __invoke(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $time = Carbon::now();

        $result = Timebreak::where([
            'day_id' => $day_info[0]->id,
        ])
            ->latest('id')
            ->first()
            ->update(['time_comeback' => $time->toTimeString()]);

        if ($result) {
            $json['success'] = 'You are successfully resumed working day';
        } else {
            $json['error'] = 'Failed to resume working day';
        }
        return response()->json($json);
    }
}
