<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Timebreak;
use App\Models\TimeReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Time;

class TimeReportApiController extends Controller
{
    public function startDay(Request $request)
    {
        return TimeReport::createRecord($request->workplace_id);
    }

    public function pauseDay()
    {
        $day_info = TimeReport::currentDayInfo();

        return Timebreak::createRecord($day_info);
    }

    public function resumeDay()
    {
        $day_info = TimeReport::currentDayInfo();

        return Timebreak::setTimeComeback($day_info);
    }

    public function endDay()
    {
        $day_info = TimeReport::currentDayInfo();
        $timebreaks = Timebreak::where(['day_id' => $day_info[0]->id])->get();

        $total_timebreak = 0;

        if (isset($timebreaks)) {
            foreach ($timebreaks as $timebreak) {
                $time_leave      = Carbon::createFromFormat('H:i:s', $timebreak['time_leave'])->timestamp;
                $time_comeback   = Carbon::createFromFormat('H:i:s', $timebreak['time_comeback'])->timestamp;
                $rounded_diff    = round((($time_comeback - $time_leave) / 32400), 4);
                $total_timebreak += $rounded_diff;
            }
        }

        $time_start = Carbon::createFromFormat('H:i:s', $day_info[0]->time_start)->timestamp;
        $time_end   = Carbon::parse(date('H:i:s'))->timestamp;
        $total = round((($time_end - $time_start) / 32400), 2) - $total_timebreak;

        $result = TimeReport::setTotal();
    }

    public function getTotal()
    {

    }
}
