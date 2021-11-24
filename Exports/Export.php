<?php

namespace Modules\Admin\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class Export implements ShouldAutoSize, WithProperties
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

}
