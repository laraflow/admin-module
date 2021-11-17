<?php

namespace Modules\Admin\Observers\Rbac;


use Modules\Admin\Models\Rbac\Role;
use Modules\Admin\Notifications\Rbac\Role\RoleCreatedNotification;
use Modules\Admin\Notifications\Rbac\Role\RoleDeletedNotification;
use Modules\Admin\Services\Rbac\UserService;

class RoleObserver
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the Role "created" event.
     *
     * @param Role $role
     * @return void
     * @throws \Exception
     */
    public function created(Role $role)
    {
//send notification to all super admin about new user
        if ($admins = $this->userService->getUsersByRoleName('Super Administrator')) {
            foreach ($admins as $admin)
                $admin->notify(new RoleCreatedNotification($role));
        }
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param Role $role
     * @return void
     */
    public function updated(Role $role)
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param Role $role
     * @return void
     * @throws \Exception
     */
    public function deleted(Role $role)
    {
        //send notification to all super admin about new user
        if ($admins = $this->userService->getUsersByRoleName('Super Administrator')) {
            foreach ($admins as $admin)
                $admin->notify(new RoleDeletedNotification($role));
        }
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param Role $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param Role $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
