<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Time\StartDayRequest;
use App\Actions\Time\EndDayAction;
use App\Actions\Time\PauseDayAction;
use App\Actions\Time\StartDayAction;
use App\Actions\Time\ResumeDayAction;
use App\Actions\Time\AddCommentAction;

class TimeReportApiController extends Controller
{
    /**
     * Start working day method
     *
     * @param StartDayRequest $request
     * @param StartDayAction $startDayAction
     * @return JsonResponse
     */
    public function startDay(StartDayRequest $request, StartDayAction $startDayAction): JsonResponse
    {
        return $startDayAction($request);
    }

    /**
     * Pause working day method
     *
     * @param PauseDayAction $pauseDayAction
     * @return JsonResponse
     */
    public function pauseDay(PauseDayAction $pauseDayAction): JsonResponse
    {
        return $pauseDayAction();
    }

    /**
     * Resume working day method
     *
     * @param Request $request
     * @param ResumeDayAction $resumeDayAction
     * @return JsonResponse
     */
    public function resumeDay(Request $request,ResumeDayAction $resumeDayAction): JsonResponse
    {
        return $resumeDayAction($request);
    }

    /**
     * End working day method
     *
     * @param Request $request
     * @param EndDayAction $endDayAction
     * @return JsonResponse
     */
    public function endDay(Request $request, EndDayAction $endDayAction): JsonResponse
    {
        return $endDayAction($request);
    }

    /**
     * Add comment for current working day
     *
     * @param Request $request
     * @param AddCommentAction $addCommentAction
     * @return JsonResponse
     */
    public function addComment(Request $request, AddCommentAction $addCommentAction): JsonResponse
    {
        return $addCommentAction($request);
    }
}
