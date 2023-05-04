<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use App\Models\UserSchedule;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StartDayAction
{
    /**
     * Start working day for Authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->checkEndDay();

        $request->merge([
            'user_id'    => Auth::id(),
            'date'       => Carbon::now()->toDateString(),
            'time_start' => Carbon::now()->toTimeString()
        ]);

        if (TimeReport::create($request->all())) {
            $json['success'] = 'You are successfully started working day';
        } else {
            $json['error'] = 'Failed to start working day';
        }
        return response()->json($json);
    }

    /**
     * Checks if the user has finished their last working day before starting a new one
     *
     * @return void
     */
    private function checkEndDay(): void
    {
        $last_day_info = TimeReport::lastDayInfo();

        if (!isset($last_day_info->time_end)) {
            $last_timebreak_info = Timebreak::getLastTimebreak($last_day_info->id);

            $schedule = UserSchedule::getUserSchedule();

            $work_schedule = CarbonInterval::createFromFormat('H:i:s', $schedule->time)->totalSeconds;
            if (isset($last_timebreak_info)) {
                if (isset($last_timebreak_info->time_comeback)) {
                    $time_end = Carbon::createFromFormat('H:i:s', $last_day_info->time_start)->addSeconds($work_schedule)->toTimeString();

                    $last_day_info->update([
                        'time_end' => $time_end
                    ]);

                    $comment = 'Забыл завершить смену, смена завершена автоматически';
                } else {
                    $last_timebreak_info->update([
                        'time_comeback' => $last_timebreak_info->time_leave
                    ]);

                    $last_day_info->update([
                        'time_end' => $last_timebreak_info->time_leave
                    ]);

                    $comment = 'Не вернулся на работу, смена завершена автоматически';
                }
            } else {
                $time_end = Carbon::createFromFormat('H:i:s', $last_day_info->time_start)->addSeconds($work_schedule)->toTimeString();

                $last_day_info->update([
                    'time_end' => $time_end
                ]);

                $comment = 'Забыл завершить смену, смена завершена автоматически';
            }
            $total_timebreak = EndDayAction::getTotalTimebreak($last_day_info->id, $work_schedule);
            $total           = EndDayAction::getTotal($last_day_info, $work_schedule, $total_timebreak);

            $data = [
                'total_timebreak' => $total_timebreak,
                'total'           => $total['total'],
                'forgot_flag'     => 1,
                'comment'         => $last_day_info->comment.' '.$comment
            ];

            $last_day_info->update($data);
        }
    }
}
