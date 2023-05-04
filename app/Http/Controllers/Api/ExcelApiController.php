<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Actions\Excel\CreateSelfReportAction;
use App\Actions\Excel\CreateFullReportAction;
use App\Actions\Excel\CreateTotalReportAction;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExcelApiController extends Controller
{

    /**
     * Download total time report xlsx sheet for current month, for authenticated user
     *
     * @param CreateSelfReportAction $createSelfReportAction
     * @return JsonResponse
     * @throws Exception
     */
    public function getPersonalReport(CreateSelfReportAction $createSelfReportAction): JsonResponse
    {
        return $createSelfReportAction();
    }

    /**
     * Download total time report xlsx sheet for current month, for all users
     *
     * @param CreateTotalReportAction $createTotalReportAction
     * @return JsonResponse
     * @throws Exception
     */
    public function getTotalReport(CreateTotalReportAction $createTotalReportAction): JsonResponse
    {
        return $createTotalReportAction();
    }

    /**
     * Download full time report xlsx sheet for current month, for all users
     *
     * @param CreateFullReportAction $createFullReportAction
     * @return JsonResponse
     * @throws Exception
     */
    public function getFullReport(CreateFullReportAction $createFullReportAction): JsonResponse
    {
        return $createFullReportAction();
    }
}
