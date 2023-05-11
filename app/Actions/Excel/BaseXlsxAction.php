<?php

namespace App\Actions\Excel;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BaseXlsxAction
{
    public static array $black_thin_border = array (
        'borders' => array (
            'outline' => array (
                'borderStyle' => Border::BORDER_THIN,
                'color'       => array ('rgb' => '000000')
            )
        )
    );

    /**
     * Filling header cells with preset values for Books.xlsx
     *
     * @param Worksheet $sheet
     * @return void
     */
    public function setBooksHeader(Worksheet $sheet): void
    {
        $sheet->setCellValue('A1', 'Книга');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getStyle('A1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('B1', 'Автор');
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getStyle('B1')->applyFromArray(self::$black_thin_border);

        $sheet->setCellValue('C1', 'Категория');
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getStyle('C1')->applyFromArray(self::$black_thin_border);
    }
}
