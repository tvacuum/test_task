<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Excel\CreateBooksXlsxAction;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExcelApiController extends Controller
{
    public function downloadBooks(CreateBooksXlsxAction $createBooksXlsxAction): JsonResponse
    {
        return $createBooksXlsxAction();
    }
}
