<?php

namespace App\Actions\Time;

use App\Models\Timebreak;
use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ResumeDayAction
{
    /**
     * Resume current working day for Authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $result = Timebreak::where([
            'day_id' => $day_info->id,
        ])
            ->latest('id')
            ->first()
            ->update([
                'time_comeback'          => Carbon::now()->toTimeString(),
                'comeback_workplace_id'  => $request->workplace_id
            ]);

        $day_info->update(['workplace_id' => $request->workplace_id]);

        if ($result) {
            $json['success'] = 'You are successfully resumed working day';
        } else {
            $json['error'] = 'Failed to resume working day';
        }
        return response()->json($json);
    }
}
