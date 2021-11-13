<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Database\Rbac\Seeders\PermissionSeeder;
use Modules\Admin\Database\Rbac\Seeders\RolePermissionSeeder;
use Modules\Admin\Database\Rbac\Seeders\RoleSeeder;
use Modules\Admin\Database\Rbac\Seeders\UserSeeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RolePermissionSeeder::class);

    }
}
