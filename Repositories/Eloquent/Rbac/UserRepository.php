<?php


namespace Modules\Admin\Repositories\Eloquent\Rbac;


use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\Admin\Models\User;
use Modules\Admin\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct($model = null)
    {
        /**
         * Set the model that will be used for repo
         */
        $model = $model ?? new User();

        parent::__construct($model);
    }

    /**
     * @param User|null $user
     * @return Collection
     */
    public function getAssignedRoles(User $user = null): ?Collection
    {
        if (is_null($user))
            return $this->model->roles;
        else
            return $user->roles;
    }


    /**
     * @param array $roles
     * @param bool $detachOldRoles
     * @return bool
     */
    public function manageRoles(array $roles = [], bool $detachOldRoles = false): bool
    {

        $alreadyAssignedRoles = [];

        $roleCollection = $this->getAssignedRoles();

        if ($roleCollection != null):
            $alreadyAssignedRoles = $roleCollection->pluck('id')->toArray();
        endif;

        $roleIds = ($detachOldRoles) ? $roles : array_unique(array_merge($alreadyAssignedRoles, $roles));


        return (bool)$this->model->roles()->sync($roleIds, ['model_type' => get_class($this->model)]);
    }

    /**
     * @param string $roleName
     * @return mixed
     */
    public function usersByRole(string $roleName)
    {
        return $this->model->role($roleName)->get();
    }

    /**
     * @param string $testUserName
     * @return bool
     * @throws \Exception
     */
    public function verifyUniqueUsername(string $testUserName): bool
    {
        if ($existingUser = $this->findFirstWhere('username', '=', $testUserName)) {
            return false;
        }
        return true;
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
                ->orWhere('username', 'like', "%{$filters['search']}%")
                ->orWhere('email', '=', "%{$filters['search']}%")
                ->orWhere('mobile', '=', "%{$filters['search']}%")
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
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public function getAllUserWith(array $filters = [], array $eagerRelations = [], bool $is_sortable = false)
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
