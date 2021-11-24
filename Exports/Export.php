<?php

namespace Modules\Admin\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Export implements ShouldAutoSize, WithProperties, WithStyles
{
    /**
     * Export collection that will be exported
     *
     * @var Collection $collection
     */
    public $collection;

    /**
     * @return string[]
     */
    public function properties(): array
    {
        return [
            'creator' => 'Patrick Brouwers',
            'lastModifiedBy' => 'Patrick Brouwers',
            'title' => 'Invoices Export',
            'description' => 'Latest Invoices',
            'subject' => 'Invoices',
            'keywords' => 'invoices,export,spreadsheet',
            'category' => 'Invoices',
            'manager' => 'Patrick Brouwers',
            'company' => 'Maatwebsite',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'name' => 'Arial',
                    'color' => ['argb' => Color::COLOR_WHITE]
                ],
                'alignment' => [
                    'horizontal' => 'center',
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'color' => ['argb' => Color::COLOR_BLACK]
                ]
            ]
        ];
    }
}
