<?php

namespace App\Http\Controllers\Api;

use App\Models\Timebreak;
use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class TimeReportApiController extends Controller
{
    public function startDay(Request $request) : JsonResponse
    {
        return TimeReport::createRecord($request->workplace_id);
    }

    public function pauseDay(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        return Timebreak::createRecord($day_info);
    }

    public function resumeDay(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        return Timebreak::setTimeComeback($day_info);
    }

    public function endDay(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $timebreaks = Timebreak::where(['day_id' => $day_info[0]->id])->get();

        $total_timebreak = 0;

        if (isset($timebreaks)) {
            foreach ($timebreaks as $timebreak) {
                $time_leave       = Carbon::createFromFormat('H:i:s', $timebreak['time_leave'])->timestamp;
                $time_comeback    = Carbon::createFromFormat('H:i:s', $timebreak['time_comeback'])->timestamp;
                $rounded_diff     = round((($time_comeback - $time_leave) / 32400), 4);
                $total_timebreak += $rounded_diff;
            }
        }

        $time_start = Carbon::createFromFormat('H:i:s', $day_info[0]->time_start)->timestamp;
        $time_end   = Carbon::parse(date('H:i:s'))->timestamp;
        $total = round((($time_end - $time_start) / 32400), 2) - $total_timebreak;

        return TimeReport::setTotal($day_info, $total_timebreak, $total);
    }
}
