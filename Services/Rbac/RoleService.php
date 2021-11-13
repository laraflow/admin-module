<?php


namespace Modules\Admin\Services\Rbac;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Rbac\Role;
use Modules\Admin\Repositories\Eloquent\Rbac\RoleRepository;
use Modules\Admin\Supports\Constant;

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
     * @return array
     * @throws \Exception|\Throwable
     */
    public function storeRole(array $inputs): array
    {
        \DB::beginTransaction();

        try {
            $newRole = $this->roleRepository->create($inputs);
            if ($newRole instanceof Role) {
                \DB::commit();
                return ['status' => true, 'message' => __('New Role Created'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('New Role Creation Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (\Exception $exception) {
            $this->roleRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }

    /**
     * @param array $inputs
     * @param $id
     * @return array
     * @throws \Throwable
     */
    public function updateRole(array $inputs, $id): array
    {
        \DB::beginTransaction();
        try {
            if ($this->roleRepository->update($inputs, $id)) {
                \DB::commit();
                return ['status' => true, 'message' => __('Role Info Updated'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('Role Info Update Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (\Exception $exception) {
            $this->roleRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
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
     * @return array
     * @throws \Throwable
     */
    public function destroyRole($id): array
    {
        \DB::beginTransaction();
        try {
            if ($this->roleRepository->detachPermissions([], $id)
                && $this->roleRepository->delete($id)) {
                \DB::commit();
                return ['status' => true, 'message' => __('Role is Trashed'),
                    'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!'];
            } else {
                \DB::rollBack();
                return ['status' => false, 'message' => __('Role is Delete Failed'),
                    'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
            }
        } catch (\Exception $exception) {
            $this->roleRepository->handleException($exception);
            \DB::rollBack();
            return ['status' => false, 'message' => $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_WARNING, 'title' => 'Error!'];
        }
    }
}
