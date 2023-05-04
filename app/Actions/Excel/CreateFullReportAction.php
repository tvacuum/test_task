<?php

namespace App\Actions\Excel;

use App\Models\TimeReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreateFullReportAction extends BaseReportAction
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

        $this->setFullReportHeader($sheet);

        $result = $this->fillFullSheet($sheet);

        if (isset($result['success'])) {
            $writer = new Xlsx($spreadsheet);

            $filename = 'full_report_' . Carbon::now()->toDateString() . '.xlsx';

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
    public function fillFullSheet(Worksheet $sheet): array
    {
        $monthly_report = TimeReport::getTotalReport();

        if ($monthly_report->isEmpty()) {
            $json['error'] = 'Failed to find any records in database for that month';
        } else {
            $i = 2;
            foreach ($monthly_report as $row) {
                $sheet->setCellValue('A' . $i, $row->firstname.' '.$row->lastname);
                $sheet->getStyle('A' . $i)->applyFromArray(parent::$black_thin_border);
                $sheet->setCellValue('B' . $i, $row->date);
                $sheet->getStyle('B' . $i)->applyFromArray(parent::$black_thin_border);
                $sheet->setCellValue('C' . $i, $row->time_start);
                $sheet->getStyle('C' . $i)->applyFromArray(parent::$black_thin_border);
                $sheet->setCellValue('D' . $i, $row->time_end);
                $sheet->getStyle('D' . $i)->applyFromArray(parent::$black_thin_border);
                $sheet->setCellValue('E' . $i, $row->name);
                $sheet->getStyle('E' . $i)->applyFromArray(parent::$black_thin_border);
                $sheet->setCellValue('F' . $i, '');
                $sheet->getStyle('F' . $i)->applyFromArray(parent::$black_thin_border);
                if (isset($row->without_lunch) && $row->without_lunch != 0) {
                    $sheet->getStyle('F' . $i)->applyFromArray(parent::$deep_green_fill);
                }
                $sheet->setCellValue('G' . $i, '');
                $sheet->getStyle('G' . $i)->applyFromArray(parent::$black_thin_border);
                if (isset($row->forgot_flag) && $row->forgot_flag != 0) {
                    $sheet->getStyle('G' . $i)->applyFromArray(parent::$deep_green_fill);
                }
                $sheet->setCellValue('H' . $i, $row->total_timebreak);
                $sheet->getStyle('H' . $i)->applyFromArray(parent::$black_thin_border);

                $sheet->setCellValue('I' . $i, $row->total);
                $sheet->getStyle('I' . $i)->applyFromArray(parent::$black_thin_border);
                if ($row->total >= 1) {
                    $sheet->getStyle('I' . $i)->applyFromArray(parent::$green_fill);
                }

                $sheet->setCellValue('J' . $i, $row->comment);
                $sheet->getStyle('J' . $i)->applyFromArray(parent::$black_thin_border);
                $i++;
            }
            $json['success'] = 'Full report successfully download';
        }
        return $json;
    }
}
