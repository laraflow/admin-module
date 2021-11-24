<?php

namespace Modules\Admin\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Export implements ShouldAutoSize, WithStyles
{
    /**
     * Export collection that will be exported
     *
     * @var Collection $collection
     */
    protected $collection;

    /**
     * Export Construct
     */
    public function __construct()
    {
        $this->collection = new Collection();
    }

    /**
     * @param $collection
     * @return $this
     */
    public function setCollection($collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Worksheet $sheet
     * @return void
     * @throws Exception
     */
    public function styles(Worksheet $sheet)
    {
        //Page Size
        $sheet->getPageSetup()
            ->setPaperSize(PageSetup::PAPERSIZE_A4)
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        //Page margin
        $sheet->getPageMargins()
            ->setBottom(0.5)
            ->setLeft(0.5)
            ->setRight(0.5)
            ->setTop(0.5);

        //Default Font size for whole sheet
        $sheet->getParent()->getDefaultStyle()->getFont()
            ->setName('Arial')
            ->setSize(12);

    //Default wrap text for whole sheet
        $sheet->getParent()->getDefaultStyle()->getAlignment()
        ->setWrapText(true);

        //Header Style
        $sheet->getStyle(1)
            ->applyFromArray([
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ]);

    }
}
