<?php

namespace App\Actions\Time;


use App\Models\TimeReport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StartDayAction
{
    public function __invoke(Request $request): JsonResponse
    {
        $time = Carbon::now();

        $request->merge([
            'user_id'    => Auth::id(),
            'date'       => $time->toDateString(),
            'time_start' => $time->toTimeString()
        ]);

        if (TimeReport::create($request->all())) {
            $json['success'] = 'You are successfully started working day';
        } else {
            $json['error'] = 'Failed to start working day';
        }
        return response()->json($json);
    }
}
