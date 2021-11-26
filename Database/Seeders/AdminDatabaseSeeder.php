<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Admin\Database\Seeders\Rbac\PermissionSeeder;
use Modules\Admin\Database\Seeders\Rbac\RolePermissionSeeder;
use Modules\Admin\Database\Seeders\Rbac\RoleSeeder;
use Modules\Admin\Database\Seeders\Rbac\UserSeeder;
use Spatie\Permission\PermissionRegistrar;

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
        $this->call(UserRegisterSeeder::class);

        //Call This on last
        $this->resetPermissionCache();
    }

    protected function resetPermissionCache()
    {
        return app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
