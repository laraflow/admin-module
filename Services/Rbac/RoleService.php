<?php


namespace Modules\Backend\Services\Authorization;


use Modules\Rbac\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Rbac\Repositories\Eloquent\RoleRepository;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * PermissionService constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->roleRepository->itemsPerPage = 10;
    }

    /**
     * @return Collection|Model[]
     */
    public function getAllRoles()
    {
        return $this->roleRepository->all();
    }

    /**
     * @param array $filters
     * @param array $eagerRelations
     * @return mixed
     * @throws \Exception
     */
    public function rolePaginate(array $filters = [], array $eagerRelations = [])
    {
        return $this->roleRepository->paginateWith($filters, $eagerRelations, true);
    }

    /**
     * @param int $id
     * @param bool $purge
     * @return mixed
     * @throws \Exception
     */
    public function getRoleById(int $id, bool $purge = false)
    {
        return $this->roleRepository->show($id, $purge);
    }

    /**
     * @param array $inputs
     * @return bool
     * @throws \Exception|\Throwable
     */
    public function storeRole(array $inputs): bool
    {
        \DB::beginTransaction();
        try {
            $newRole = $this->roleRepository->create($inputs);
            if ($newRole instanceof Role) {
                //attach permissions
                $this->roleRepository->attachPermissions($inputs['permissions'], $newRole->id);
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
    public function updateRole(array $inputs, $id)
    {
        \DB::beginTransaction();
        try {
            if ($this->roleRepository->update($inputs, $id)) {
                //attach permissions
                $this->roleRepository->syncPermissions($inputs['permissions'], $id);
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
     * @param array $filters
     * @return array
     */
    public function roleDropdown(array $filters = []): array
    {
        $roleCollection = $this->roleRepository->all();
        $roles = [];
        foreach ($roleCollection as $role)
            $roles[$role->id] = $role['name'];

        return $roles;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function destroyRole($id): bool
    {
        \DB::beginTransaction();
        try {
            if ($this->roleRepository->detachPermissions([], $id)
                && $this->roleRepository->delete($id)) {
                \DB::commit();
                return true;
            } else {
                \DB::rollBack();
                return false;
            }
        } catch (\Exception $exception) {
            $this->roleRepository->handleException($exception);
            \DB::rollBack();
            return false;
        }
    }
}
