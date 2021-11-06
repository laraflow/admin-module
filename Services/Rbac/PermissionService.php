<?php

namespace Modules\Admin\Services\Rbac;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Rbac\Permission;
use Modules\Admin\Repositories\Eloquent\Rbac\PermissionRepository;


class PermissionService
{
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * PermissionService constructor.
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->permissionRepository->itemsPerPage = 10;
    }

    /**
     * @return Collection|Model[]
     */
    public function getAllPermissions()
    {
        return $this->permissionRepository->all();
    }

    /**
     * @param array $filters
     * @param array $eagerRelations
     * @return mixed
     * @throws \Exception
     */
    public function permissionPaginate(array $filters = [], array $eagerRelations = [])
    {
        return $this->permissionRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws \Exception
     */
    public function getPermissionById(int $id, bool $purge = false)
    {
        return $this->permissionRepository->show($id, $purge);
    }

    /**
     * @param array $inputs
     * @return bool
     * @throws \Exception
     * @throws \Throwable
     */
    public function storePermission(array $inputs): bool
    {
        \DB::beginTransaction();
        try {
            $newPermission = $this->permissionRepository->create($inputs);
            if ($newPermission instanceof Permission) {
                \DB::commit();
                return true;
            } else {
                \DB::rollBack();
                return false;
            }
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            \DB::rollBack();
            return false;
        }
    }

    /**
     * @param array $inputs
     * @param $id
     * @return mixed
     * @throws \Throwable
     */
    public function updatePermission(array $inputs, $id)
    {
        \DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->update($inputs, $id);
            if ($permission instanceof Permission) {
                \DB::commit();
                return true;
            } else {
                \DB::rollBack();
                return false;
            }
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            \DB::rollBack();
            return false;
        }

    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function destroyPermission($id): bool
    {
        \DB::beginTransaction();
        try {
            if ($this->permissionRepository->delete($id)) {
                \DB::commit();
                return true;
            } else {
                \DB::rollBack();
                return false;
            }
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            \DB::rollBack();
            return false;
        }
    }
}
