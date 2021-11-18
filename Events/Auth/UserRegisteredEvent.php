<?php

namespace Modules\Admin\Events\Auth;

use Illuminate\Queue\SerializesModels;
use Modules\Admin\Models\User;

class UserRegisteredEvent
{
    use SerializesModels;

    /**
     * @var User $user
     */
    public $user;


    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
