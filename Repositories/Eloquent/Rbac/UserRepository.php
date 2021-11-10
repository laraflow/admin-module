<?php

namespace Modules\Admin\Repositories\Eloquent\Rbac;

use Modules\Core\Models\User;
use Modules\Core\Repositories\Eloquent\Auth\UserRepository as CoreUserRepository;

class UserRepository extends CoreUserRepository
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
