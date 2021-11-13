<?php

namespace Modules\Admin\Models\Rbac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\Rbac\UserFactory;
use Modules\Admin\Models\User as AdminUser;

class User extends AdminUser
{
    use HasFactory;

    protected $fillable = [];


    /**
     * Set Custom Factory Location
     *
     */
    protected static function newFactory() : UserFactory
    {
        return UserFactory::new();
    }

}
