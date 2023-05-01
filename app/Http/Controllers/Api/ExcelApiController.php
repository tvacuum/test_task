<?php

namespace App\Http\Controllers\Api;

use App\Models\TimeReport;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelApiController extends Controller
{
    private array $alphabet = array (
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
        'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG'
    );

    private array $alphabet_with_keys = array (
        "1" => 'B', "2" => 'C', "3" => 'D', "4" => 'E', "5" => 'F', "6" => 'G', "7" => 'H', "8" => 'I', "9" => 'J', "10" => 'K',
        "11" => 'L', "12" => 'M', "13" => 'N', "14" => 'O', "15" => 'P', "16" => 'Q', "17" => 'R', "18" => 'S', "19" => 'T', "20" => 'U', "21" => 'V',
        "22" => 'W', "23" => 'X', "24" => 'Y', "25" => 'Z', "26" => 'AA', "27" => 'AB', "28" => 'AC', "29" => 'AD', "30" => 'AE', "31" => 'AF', "32" => 'AG'
    );

    private array $blue_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THICK,
                'color'       => array ('rgb' => '3a8ecf')
            )
        )
    );

    public function downloadPersonalReport(): void
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $this->setDateLine($sheet);
        $this->fillPersonalSheet($sheet);

        $writer = new Xlsx($spreadsheet);

        $filename = 'personal_report_' . Carbon::now()->format('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');

        $writer->save('php://output');
    }

    public function setDateLine(Worksheet $sheet): void
    {
        $sheet->setCellValue('A1', 'Сотрудник');

        $day_count = Carbon::now()->daysInMonth;

        foreach($this->alphabet_with_keys as $number => $letter) {
            $sheet->setCellValue($letter . 1, Carbon::now()->month . '-' . $number);

            $is_weekend = Carbon::createFromFormat('m-d', Carbon::now()->month . '-' . $number)->isWeekend();

            if ($is_weekend) {
                $sheet->getStyle($letter . 2)->applyFromArray($this->blue_border);
            }

            if($number >= $day_count){
                break;
            }
        }
    }

    public function fillPersonalSheet(Worksheet $sheet): JsonResponse
    {
        $rows = TimeReport::getPersonalReport();

        if ($rows->isEmpty()) {
            $json['error'] = 'Failed to find any records in database for that month';
        } else {
            $sheet->setCellValue('A2', $rows[0]['firstname'] .' '. $rows[0]['lastname']);

            foreach ($rows as $row) {
                $date = explode('-', $row->date);
                $day  = $date[2];

                $sheet->setCellValue($this->alphabet[$day] . 2, $row->total);
            }
            $json['success'] = 'Personal fact report successfully download';
        }
        return response()->json($json);
    }
}
