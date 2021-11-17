<?php

namespace Modules\Admin\Observers\Rbac;


use Modules\Admin\Models\Rbac\Permission;
use Modules\Admin\Notifications\Rbac\Permission\PermissionCreatedNotification;
use Modules\Admin\Notifications\Rbac\Permission\PermissionDeletedNotification;
use Modules\Admin\Services\Rbac\UserService;

class PermissionObserver
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
     * Handle the Permission "created" event.
     *
     * @param Permission $permission
     * @return void
     * @throws \Exception
     */
    public function created(Permission $permission)
    {
        //send notification to all super admin about new user
        if($admins = $this->userService->getUsersByRoleName('Super Administrator')) {
            foreach ($admins as $admin)
                $admin->notify(new PermissionCreatedNotification($permission));
        }
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param Permission $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param Permission $permission
     * @return void
     * @throws \Exception
     */
    public function deleted(Permission $permission)
    {
        //send notification to all super admin about new user
        if($admins = $this->userService->getUsersByRoleName('Super Administrator')) {
            foreach ($admins as $admin)
                $admin->notify(new PermissionDeletedNotification($permission));
        }
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param Permission $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param Permission $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}
