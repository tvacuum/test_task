<?php

namespace App\Actions\Excel;

use App\Models\TimeReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreateTotalReportAction extends BaseReportAction
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

        $result = $this->fillTotalSheet($sheet);

        if (isset($result['success'])) {
            $writer = new Xlsx($spreadsheet);

            $filename = 'total_report_' . Carbon::now()->toDateString() . '.xlsx';

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
    public static function fillTotalSheet(Worksheet $sheet): array
    {
        $monthly_report = TimeReport::getTotalReport();
        if ($monthly_report->isEmpty()) {
            $json['error'] = 'Failed to find any records in database for that month';
        } else {
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->setCellValue('A1', 'Сотрудники');

            $i = 0;
            $j = 1;
            $k = 2;
            $user_id = null;

            foreach ($monthly_report as $row) {
                if ($user_id != $row->user_id) {
                    $sheet->setCellValue('A' . $k, $row->firstname .' '. $row->lastname);
                    $k++;
                    $j++;
                }
                $date = explode('-', $row->date);

                $i  = intval($date[2]);

                $sheet->setCellValue(parent::$alphabet[$i] . $j, $row->total);
                if ($row->total >= 1) {
                    $sheet->getStyle(parent::$alphabet[$i] . $j)->applyFromArray(parent::$green_fill);
                }

                $i = null;

                $user_id = $row->user_id;
            }

            $unique_users = $monthly_report->groupBy('user_id')->map(function ($people) {
                return $people->count();
            });

            $days_count = Carbon::now()->daysInMonth;

            for ($l = 1; $l <= $unique_users->count(); $l++) {
                $sheet->getStyle('A'.$l+1)->applyFromArray(parent::$black_thin_border);

                for ($e = 1; $e <= $days_count; $e++) {
                    $is_weekend = Carbon::createFromFormat('m-d', Carbon::now()->month . '-' . $e)->isWeekend();

                    if ($is_weekend) {
                        $sheet->getStyle(parent::$alphabet_with_keys[$e]. $l+1)->applyFromArray(parent::$yellow_thick_border);
                    } else {
                        $sheet->getStyle(parent::$alphabet_with_keys[$e]. $l+1)->applyFromArray(parent::$black_thin_border);
                    }
                }
            }

            $json['success'] = 'Total fact report successfully download';
        }
        return $json;
    }
}
