<?php

namespace Modules\Admin\Observers\Rbac;


use Modules\Admin\Models\User;
use Modules\Admin\Notifications\Rbac\User\UserCreatedNotification;
use Modules\Admin\Services\Rbac\UserService;

class UserObserver
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserObserver constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the Preference "created" event.
     *
     * @param User $user
     * @return void
     * @throws \Exception
     */
    public function created(User $user)
    {
        //send notification to all super admin about new user
        if($admins = $this->userService->getUsersByRoleName('Super Administrator')) {
            foreach ($admins as $admin)
                $admin->notify(new UserCreatedNotification($user));
        }
    }

    /**
     * Handle the Preference "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the Preference "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the Preference "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the Preference "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
