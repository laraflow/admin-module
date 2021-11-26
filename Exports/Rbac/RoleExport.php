<?php

namespace Modules\Admin\Exports\Rbac;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Modules\Admin\Models\Rbac\Role;
use Modules\Admin\Exports\Export;

class RoleExport extends Export
{
    /**
     * @param null $data
     * @throws InvalidArgumentException
     */
    public function __construct($data = null)
    {
        parent::__construct();

        $this->data($data);
    }

    /**
     * @param Role $row
     * @return array
     */
    public function map($row): array
    {
        $this->formatRow = [
            '#' => $row->id,
            'Display Name' => $row->name,
            'Guard' => ucfirst($row->guard_name),
            'Remarks' => $row->remarks,
            'Enabled' => ucfirst($row->enabled),
            'Created' => $row->created_at->format(config('app.datetime')),
            'Updated' => $row->updated_at->format(config('app.datetime'))
        ];

        $this->getSupperAdminColumns($row);

        return $this->formatRow;
    }
}
