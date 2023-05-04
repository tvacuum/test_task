<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use App\Models\UserSchedule;
use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EndDayAction
{
    /**
     * End current working day for Authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $schedule = UserSchedule::getUserSchedule();

        $work_schedule   = CarbonInterval::createFromFormat('H:i:s', $schedule->time)->totalSeconds;

        $total_timebreak = $this->getTotalTimebreak($day_info->id, $work_schedule);

        $total = $this->getTotal($day_info, $work_schedule, $total_timebreak, $request->without_lunch);

        $result = TimeReport::where(['id' => $day_info->id])
            ->update([
                'time_end'        => Carbon::now()->toTimeString(),
                'total_timebreak' => $total_timebreak,
                'total'           => $total['total'],
                'without_lunch'   => $total['lunch_flag']
            ]);

        if ($result) {
            $json['success'] = 'You are successfully ended working day';
        } else {
            $json['error'] = 'Failed to end working day';
        }

        return response()->json($json);
    }

    /**
     * Calculate Time break's total for current working day
     *
     * @param int $day_id
     * @param float $work_schedule
     * @return float
     */
    public static function getTotalTimebreak(int $day_id, float $work_schedule): float
    {
        $timebreaks = Timebreak::where(['day_id' => $day_id])->get();

        $total_timebreak = 0;

        if (isset($timebreaks)) {
            foreach ($timebreaks as $timebreak) {
                $time_leave       = Carbon::createFromFormat('H:i:s', $timebreak['time_leave'])->timestamp;
                $time_comeback    = Carbon::createFromFormat('H:i:s', $timebreak['time_comeback'])->timestamp;
                $rounded_diff     = round((($time_comeback - $time_leave) / $work_schedule), 4);
                $total_timebreak += $rounded_diff;
            }
        }

        return floatval($total_timebreak);
    }

    /**
     * Calculate Total for current working day
     *
     * @param TimeReport $day_info
     * @param float $work_schedule
     * @param float $total_timebreak
     * @param bool|null $without_lunch
     * @return array
     */
    public static function getTotal(TimeReport $day_info, float $work_schedule, float $total_timebreak, bool $without_lunch = null): array
    {
        $time_start = Carbon::createFromFormat('H:i:s', $day_info->time_start)->timestamp;

        if(isset($day_info->time_end)) {
            $time_end = Carbon::createFromFormat('H:i:s', $day_info->time_end)->timestamp;
        } else {
            $time_end = Carbon::now()->timestamp;
        }

        if($without_lunch) {
            $pre_total   = (($time_end - $time_start) / ($work_schedule - 3600)) - $total_timebreak;
        } else {
            $pre_total   = (($time_end - $time_start) / $work_schedule) - $total_timebreak;
        }

        return [
            'total'      => round($pre_total, 2),
            'lunch_flag' => $without_lunch
        ];
    }
}
