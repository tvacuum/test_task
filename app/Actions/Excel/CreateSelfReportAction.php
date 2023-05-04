<?php

namespace App\Actions\Excel;

use App\Models\TimeReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreateSelfReportAction extends BaseReportAction
{
    /**
     * Default script for create / fill / download table
     *
     * @return JsonResponse|void
     * @throws Exception
     */
    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $this->setDateLine($sheet);

        $result = $this->fillPersonalSheet($sheet);

        if (isset($result['success'])) {
            $writer = new Xlsx($spreadsheet);

            $filename = 'personal_report_' . Carbon::now()->toDateString() . '.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');

            $writer->save('php://output');
        } else {
            return response()->json($result['error']);
        }
    }

    /**
     * Filling cells with current month's info
     *
     * @param Worksheet $sheet
     * @return array
     */
    private function fillPersonalSheet(Worksheet $sheet): array
    {
        $rows = TimeReport::getPersonalReport();

        if ($rows->isEmpty()) {
            $json['error'] = 'Failed to find any records in database for that month';
        } else {
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->setCellValue('A1', 'Сотрудник');
            $sheet->getStyle('A1')->applyFromArray(parent::$black_thin_border);
            $sheet->setCellValue('A2', $rows[0]->firstname .' '. $rows[0]->lastname);
            $sheet->getStyle('A2')->applyFromArray(parent::$black_thin_border);

            foreach ($rows as $row) {
                $date = explode('-', $row->date);

                $day  = intval($date[2]);

                $sheet->setCellValue(parent::$alphabet[$day] . 2, $row->total);
                if ($row->total >= 1) {
                    $sheet->getStyle(parent::$alphabet[$day] . 2)->applyFromArray(parent::$green_fill);
                }
            }
            $json['success'] = 'Personal fact report successfully download';
        }
        return $json;
    }
}
