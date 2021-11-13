<?php

namespace Modules\Admin\Repositories\Eloquent\Rbac;

use Modules\Admin\Models\User;
use Modules\Admin\Repositories\Eloquent\UserRepository as AdminUserRepository;

class UserRepository extends AdminUserRepository
{

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        /**
         * Set the model that will be used for repo
         */
        parent::__construct(new User);
    }
}
