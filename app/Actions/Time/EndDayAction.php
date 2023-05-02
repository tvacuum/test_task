<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class EndDayAction
{
    public function __invoke(): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $total_timebreak = $this->getTotalTimebreak($day_info[0]->id);

        $total = $this->getTotal($day_info, $total_timebreak);

        $result = TimeReport::where(['id' => $day_info[0]->id])
            ->update([
                'time_end'        => Carbon::now()->toTimeString(),
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

    private function getTotalTimebreak(int $day_id): float|int
    {
        $timebreaks = Timebreak::where(['day_id' => $day_id])->get();

        $total_timebreak = 0;

        if (isset($timebreaks)) {
            foreach ($timebreaks as $timebreak) {
                $time_leave       = Carbon::createFromFormat('H:i:s', $timebreak['time_leave'])->timestamp;
                $time_comeback    = Carbon::createFromFormat('H:i:s', $timebreak['time_comeback'])->timestamp;
                $rounded_diff     = round((($time_comeback - $time_leave) / 32400), 4);
                $total_timebreak += $rounded_diff;
            }
        }

        return floatval($total_timebreak);
    }

    private function getTotal(Collection $day_info, float $total_timebreak): float
    {
        $time_start = Carbon::createFromFormat('H:i:s', $day_info[0]->time_start)->timestamp;
        $time_end   = Carbon::now()->timestamp;

        $pre_total  = (($time_end - $time_start) / 32400) - $total_timebreak;

        return round($pre_total, 2);
    }
}
