<?php

namespace App\Exports\Concerns;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

trait StylesSheetExport
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                foreach (range('A', $highestColumn) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $sheet->getStyle('A1:'.$highestColumn.'1')
                    ->getFont()
                    ->setBold(true)
                    ->setSize(16)
                    ->getColor()
                    ->setARGB('1D4ED8');

                $sheet->getStyle('A2:'.$highestColumn.'2')
                    ->getFont()
                    ->setBold(true)
                    ->setSize(11);

                $sheet->getStyle('A5:'.$highestColumn.'5')
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('2563EB');

                $sheet->getStyle('A5:'.$highestColumn.'5')
                    ->getFont()
                    ->setBold(true)
                    ->getColor()
                    ->setARGB('FFFFFF');

                $sheet->getStyle('A5:'.$highestColumn.'5')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->getStyle('A5:'.$highestColumn.$highestRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle('A'.($highestRow > 5 ? 6 : 5).':'.$highestColumn.$highestRow)
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }
}