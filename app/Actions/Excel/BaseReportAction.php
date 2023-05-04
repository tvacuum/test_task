<?php

namespace App\Actions\Excel;

use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BaseReportAction
{
    public static array $alphabet = array (
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
        'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG'
    );

    public static array $alphabet_with_keys = array (
        "1" => 'B', "2" => 'C', "3" => 'D', "4" => 'E', "5" => 'F', "6" => 'G', "7" => 'H', "8" => 'I', "9" => 'J', "10" => 'K',
        "11" => 'L', "12" => 'M', "13" => 'N', "14" => 'O', "15" => 'P', "16" => 'Q', "17" => 'R', "18" => 'S', "19" => 'T', "20" => 'U', "21" => 'V',
        "22" => 'W', "23" => 'X', "24" => 'Y', "25" => 'Z', "26" => 'AA', "27" => 'AB', "28" => 'AC', "29" => 'AD', "30" => 'AE', "31" => 'AF', "32" => 'AG'
    );

    public static array $yellow_thick_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THICK,
                'color'       => array ('rgb' => 'fcc603')
            )
        )
    );

    public static array $green_thick_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THICK,
                'color'       => array ('rgb' => '42ad52')
            )
        )
    );

    public static array $red_thick_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THICK,
                'color'       => array ('rgb' => 'bd2828')
            )
        )
    );

    public static array $black_thin_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THIN,
                'color'       => array ('rgb' => '000000')
            )
        )
    );

    public static array $red_fill = array (
        'fill' => array(
            'fillType' => Fill::FILL_SOLID,
            'startColor' => array('rgb' => 'bd2828')
        )
    );

    public static array $green_fill = array (
        'fill' => array(
            'fillType' => Fill::FILL_SOLID,
            'startColor' => array('rgb' => '42ad52')
        )
    );

    public static array $deep_green_fill = array (
        'fill' => array(
            'fillType' => Fill::FILL_SOLID,
            'startColor' => array('rgb' => '3c7d65')
        )
    );

    /**
     * Filling header cells with current month's days
     *
     * @param Worksheet $sheet
     * @return void
     */
    public function setDateLine(Worksheet $sheet): void
    {
        $day_count = Carbon::now()->daysInMonth;

        foreach(self::$alphabet_with_keys as $number => $letter) {
            $sheet->setCellValue($letter . 1, Carbon::now()->month . '-' . $number);

            $is_weekend = Carbon::createFromFormat('m-d', Carbon::now()->month . '-' . $number)->isWeekend();

            if ($is_weekend) {
                $sheet->getStyle($letter . 1)->applyFromArray(self::$yellow_thick_border);
                $sheet->getStyle($letter . 2)->applyFromArray(self::$yellow_thick_border);
            } else {
                $sheet->getStyle($letter . 1)->applyFromArray(self::$black_thin_border);
                $sheet->getStyle($letter . 2)->applyFromArray(self::$black_thin_border);
            }

            if($number >= $day_count){
                break;
            }
        }
    }

    /**
     * Filling header cells with preset values for Full Report
     *
     * @param Worksheet $sheet
     * @return void
     */
    public function setFullReportHeader(Worksheet $sheet): void
    {
        $sheet->setCellValue('A1', 'Сотрудник');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getStyle('A1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('B1', 'Дата');
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getStyle('B1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('C1', 'Начал рабочий день');
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getStyle('C1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('D1', 'Закончил рабочий день');
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getStyle('D1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('E1', 'Рабочее место');
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getStyle('E1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('F1', 'Работал без обеда');
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getStyle('F1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('G1', 'Забыл завершить смену / Не вернулся');
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getStyle('G1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('H1', 'Факт перерыв');
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getStyle('H1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('I1', 'Факт');
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getStyle('I1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('J1', 'Комментарий');
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getStyle('J1')->applyFromArray(self::$black_thin_border);
    }
}
