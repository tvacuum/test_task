<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Excel\CreateSelfReportAction;
use Illuminate\Http\JsonResponse;

class ExcelApiController extends Controller
{
    public function getPersonalReport(CreateSelfReportAction $createSelfReportAction): JsonResponse
    {
        return $createSelfReportAction();
    }
}
