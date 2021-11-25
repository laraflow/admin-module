<?php

namespace Modules\Admin\Exports;

use Box\Spout\Common\Entity\Style\Border;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Common\Entity\Style\Style;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Modules\Admin\Services\Auth\AuthenticatedSessionService;
use Rap2hpoutre\FastExcel\FastExcel;

abstract class Export extends FastExcel
{
    /**
     * @var BorderBuilder $border
     */
    protected $borderStyle = null;

    /**
     * @var StyleBuilder
     */
    protected $headingStyle = null;

    /**
     * @var StyleBuilder
     */
    protected $rowStyle = null;

    /**
     * @var array $formatRow
     */
    public $formatRow = [];

    /**
     * Modify Output Row Cells
     *
     * @param $row
     * @return array
     */
    public abstract function map($row): array;

    /**
     * Export Constructor
     *
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        parent::__construct();

        $this->setHeadingStyle((new StyleBuilder())
            ->setFontBold()
            ->setFontSize(12)
            ->setFontColor(Color::WHITE)
            ->setShouldWrapText()
            ->setBackgroundColor(Color::BLACK)
            ->setCellAlignment(CellAlignment::CENTER)
            ->build());

        $this->setRowStyle((new StyleBuilder())
            ->setFontSize(12)
            ->setShouldWrapText()
            ->setCellAlignment(CellAlignment::LEFT)
            ->build());

        //Border Style on extend to this package
        //Origin Spout style support
        /*
        $this->setBorderStyle((new BorderBuilder())
            ->setBorderTop(Color::RED, Border::WIDTH_THIN)
            ->setBorderRight(Color::RED, Border::WIDTH_THIN)
            ->setBorderBottom(Color::RED, Border::WIDTH_THIN)
            ->setBorderLeft(Color::RED, Border::WIDTH_THIN)
            ->build());
    */
    }

    /**
     * @param Border $style
     * @return Export
     */
    public function setBorderStyle(Border $style): self
    {
        $this->borderStyle = (new StyleBuilder())
            ->setBorder($style)
            ->build();
        return $this;
    }

    /**
     * @param Style $style
     * @return Export
     */
    public function setRowStyle(Style $style): self
    {
        $this->rowsStyle($style);
        return $this;
    }

    /**
     * @param Style $style
     * @return Export
     */
    public function setHeadingStyle(Style $style): self
    {
        $this->headerStyle($style);
        return $this;
    }

    /**
     * Returns all super admin columns
     *
     * @param $row
     */
    protected function getSupperAdminColumns($row)
    {
        if (AuthenticatedSessionService::isSuperAdmin()):
            $this->formatRow['Deleted'] = ($row->deleted_at != null)
                ? $row->deleted_at->format(config('app.datetime'))
                : null;

            $this->formatRow['Creator'] = ($row->createdBy != null)
                ? $row->createdBy->name
                : null;

            $this->formatRow['Editor'] = ($row->updatedBy != null)
                ? $row->updatedBy->name
                : null;
            $this->formatRow['Destructor'] = ($row->deletedBy != null)
                ? $row->deletedBy->name
                : null;
        endif;
    }
}
