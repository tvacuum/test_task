<?php

namespace App\Actions\Time;

use App\Models\TimeReport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AddCommentAction
{
    public function __invoke(Request $request): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $result = TimeReport::where(['id' => $day_info[0]->id])
            ->update([
                'comment' => $request->comment
            ]);

        if ($result) {
            $json['success'] = 'Your comment has been successfully attached';
        } else {
            $json['error'] = 'Failed to attach your comment';
        }
        return response()->json($json);
    }
}
