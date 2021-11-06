<?php


namespace Modules\Backend\Repositories\Eloquent\Authorization;


use Modules\Rbac\Models\Role;
use App\Repositories\EloquentRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends EloquentRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        /**
         * Set the model that will be used for repo
         */
        parent::__construct(new Role);
    }

    /**
     * @param array $permissions
     * @param $id
     * @return bool
     */
    public function attachPermissions(array $permissions, $id): bool
    {
        try {
            /**
             * @var Role $role
             */
            $role = $this->show($id);
            $role->permissions()->attach($permissions);
            return true;
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return false;
        }
    }

    /**
     * @param array $permissions
     * @param $id
     * @return bool
     */
    public function syncPermissions(array $permissions, $id): bool
    {
        try {
            /**
             * @var Role $role
             */
            $role = $this->show($id);
            $role->permissions()->sync($permissions);
            return true;
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return false;
        }
    }

    /**
     * @param array $permissions
     * @param $id
     * @return bool
     */
    public function detachPermissions(array $permissions, $id): bool
    {
        try {
            /**
             * @var Role $role
             */
            $role = $this->show($id);
            $existingPermissionIds = $role->permissions()->pluck('id');

            //Remove All
            if (empty($existingPermissionIds))
                $role->permissions()->detach($existingPermissionIds);

            //Remove Selected
            else
                $role->permissions()->detach($permissions);

            return true;
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return false;
        }
    }

    /**
     * Search Function for Permissions
     *
     * @param array $filters
     * @param bool $is_sortable
     * @return Builder
     */
    private function filterData(array $filters = [], bool $is_sortable = false): Builder
    {
        $query = $this->getQueryBuilder();

        if (!empty($filters['search'])) :
            $query->where('name', 'like', "%{$filters['search']}%")
                ->orWhere('guard_name', 'like', "%{$filters['search']}%")
                ->orWhere('enabled', '=', "%{$filters['search']}%");
        endif;

        if ($is_sortable == true)
            $query->sortable();

        return $query;
    }

    /**
     * Pagination Generator
     * @param array $filters
     * @param array $eagerRelations
     * @param bool $is_sortable
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function paginateWith(array $filters = [], array $eagerRelations = [], bool $is_sortable = false): LengthAwarePaginator
    {
        $query = $this->getQueryBuilder();
        try {
            $query = $this->filterData($filters, $is_sortable);
        } catch (Exception $exception) {
            $this->handleException($exception);
        } finally {
            return $query->with($eagerRelations)->paginate($this->itemsPerPage);
        }
    }

    /**
     * @param array $filters
     * @param array $eagerRelations
     * @param bool $is_sortable
     * @return Builder[]|Collection
     * @throws Exception
     */
    public function getAllRoleWith(array $filters = [], array $eagerRelations = [], bool $is_sortable = false)
    {
        $query = $this->getQueryBuilder();
        try {
            $query = $this->filterData($filters, $is_sortable);
        } catch (Exception $exception) {
            $this->handleException($exception);
        } finally {
            return $query->with($eagerRelations)->get();
        }
    }

}
