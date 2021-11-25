<?php

namespace Modules\Admin\Exports\Rbac;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Modules\Admin\Exports\Export;
use Modules\Admin\Models\Rbac\Permission;

class UserExport extends Export
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
     * @param Permission $row
     * @return array
     */
    public function map($row): array
    {
        $this->formatRow = [
            '#' => $row->id,
            'Full Name' => $row->name,
            'Username' => $row->username,
            'Email' => $row->email,
            'Mobile' => $row->email,
            'Role(s)' => $this->mergeRoles($row->roles->pluck('name')->toArray()),
            'Remarks' => $row->remarks,
            'Enabled' => ucfirst($row->enabled),
            'Created' => $row->created_at->format(config('app.datetime')),
            'Updated' => $row->updated_at->format(config('app.datetime'))
        ];
        $this->getSupperAdminColumns($row);
        return $this->formatRow;
    }

    protected function mergeRoles(array $roles): string
    {
        if (count($roles) > 0)
            return implode(', ', $roles);
        else
            return 'Not Assigned';
    }
}
