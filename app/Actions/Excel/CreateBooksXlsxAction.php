<?php

namespace App\Actions\Excel;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CreateBooksXlsxAction extends BaseXlsxAction
{
    /**
     * Prepare and download books.xlsx
     *
     * @return JsonResponse|void
     * @throws Exception
     */
    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $this->setBooksHeader($sheet);

        $result = $this->fillSheet($sheet);

        if (isset($result['success'])) {
            $writer   = new Xlsx($spreadsheet);
            $filename = 'books.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');
            $writer->save('php://output');
        } else {
            return response()->json($result['error']);
        }
    }

    /**
     * Fill book's sheet
     *
     * @param Worksheet $sheet
     * @return array
     */
    private function fillSheet(Worksheet $sheet): array
    {
        $rows = Book::all();

        if ($rows->isEmpty()) {
            $json['error'] = 'Failed to find any records in database';
        } else {
            $i = 2;
            foreach ($rows as $row) {
                $author = $row->authors;
                $category = $row->categories;

                $sheet->setCellValue('A' . $i, $row->title);
                $sheet->getStyle('A' . $i)->applyFromArray(parent::$black_thin_border);

                $sheet->setCellValue('B' . $i, $author->firstname . ' ' . $author->lastname);
                $sheet->getStyle('B' . $i)->applyFromArray(parent::$black_thin_border);

                if (isset($category[0]['title'])) {
                    $sheet->setCellValue('C' . $i, $category[0]->title);
                }
                $sheet->getStyle('C' . $i)->applyFromArray(parent::$black_thin_border);

                $i++;
            }
            $json['success'] = 'Books.xlsx successfully downloaded';
        }
        return $json;
    }
}
