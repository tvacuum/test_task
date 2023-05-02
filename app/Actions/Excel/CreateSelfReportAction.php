<?php

namespace App\Actions\Excel;

use App\Models\TimeReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreateSelfReportAction
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

    private array $yellow_thick_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THICK,
                'color'       => array ('rgb' => 'fcc603')
            )
        )
    );

    private array $black_thin_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THIN,
                'color'       => array ('rgb' => '000000')
            )
        )
    );

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

    private function setDateLine(Worksheet $sheet): void
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->setCellValue('A1', 'Сотрудник');
        $sheet->getStyle('A1', 'Сотрудник')->applyFromArray($this->black_thin_border);

        $day_count = Carbon::now()->daysInMonth;

        foreach($this->alphabet_with_keys as $number => $letter) {
            $sheet->setCellValue($letter . 1, Carbon::now()->month . '-' . $number);

            $is_weekend = Carbon::createFromFormat('m-d', Carbon::now()->month . '-' . $number)->isWeekend();

            if ($is_weekend) {
                $sheet->getStyle($letter . 1)->applyFromArray($this->yellow_thick_border);
                $sheet->getStyle($letter . 2)->applyFromArray($this->yellow_thick_border);
            } else {
                $sheet->getStyle($letter . 1)->applyFromArray($this->black_thin_border);
                $sheet->getStyle($letter . 2)->applyFromArray($this->black_thin_border);
            }

            if($number >= $day_count){
                break;
            }
        }
    }

    private function fillPersonalSheet(Worksheet $sheet): array
    {
        $rows = TimeReport::getPersonalReport();

        if ($rows->isEmpty()) {
            $json['error'] = 'Failed to find any records in database for that month';
        } else {
            $sheet->setCellValue('A2', $rows[0]['firstname'] .' '. $rows[0]['lastname']);
            $sheet->getStyle('A2')->applyFromArray($this->black_thin_border);

            foreach ($rows as $row) {
                $date = explode('-', $row->date);

                $day  = intval($date[2]);

                $sheet->setCellValue($this->alphabet[$day] . 2, $row->total);
            }
            $json['success'] = 'Personal fact report successfully download';
        }
        return $json;
    }
}
