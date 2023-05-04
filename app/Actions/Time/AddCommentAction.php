<?php

namespace App\Actions\Time;

use App\Models\TimeReport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AddCommentAction
{
    /**
     * Add comment for current working day for Authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $day_info = TimeReport::currentDayInfo();

        $result = $day_info->where(['id' => $day_info->id])
                    ->update([
                        'comment' => $day_info->comment.' '.$request->comment
                ]);

        if ($result) {
            $json['success'] = 'Your comment has been successfully attached';
        } else {
            $json['error'] = 'Failed to attach your comment';
        }
        return response()->json($json);
    }
}
