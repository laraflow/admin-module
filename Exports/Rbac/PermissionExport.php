<?php

namespace Modules\Admin\Exports\Rbac;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Admin\Exports\Export;
use Modules\Admin\Supports\Constant;
use Modules\Admin\Supports\DefaultValue;

/**
 * @class PermissionExport
 * @package Modules/Admin/Exports/Rbac
 */
class PermissionExport extends Export implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    /**
     * Export Permission List a export file
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->getCollection();
    }

    /**
     * Modify Individual Columns
     *
     * @param mixed $row
     * @return array
     *
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->display_name,
            $row->name,
            $row->guard_name,
            $row->remarks,
            Constant::ENABLED_OPTIONS[$row->enabled ?? DefaultValue::ENABLED_OPTION],
            Carbon::parse($row->created_at)->format(config("app.datetime")),
            $row->id,
            $row->display_name,
            $row->name,
            $row->guard_name,
            $row->remarks,
            Constant::ENABLED_OPTIONS[$row->enabled ?? DefaultValue::ENABLED_OPTION],
            Carbon::parse($row->created_at)->format(config("app.datetime")),

        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Display Name',
            'Code Name',
            'Guard',
            'Remarks',
            'Enabled',
            'Created',
            '#',
            'Display Name',
            'Code Name',
            'Guard',
            'Remarks',
            'Enabled',
            'Created'
        ];
    }

}
