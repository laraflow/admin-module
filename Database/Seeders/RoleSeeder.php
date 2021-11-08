<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Rbac\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //disable Observer
        $eventDispatcher = Role::getEventDispatcher();
        Role::unsetEventDispatcher();
        Role::create([
            'id' => 1,
            'name' => 'Super Administration',
            'remarks' => 'Role which will have all privileges.'
        ]);

        Role::create([
            'id' => 2,
            'name' => 'Administration',
            'remarks' => 'Role which will have all privileges.'
        ]);

        Role::create([
            'id' => 3,
            'name' => 'Manager',
            'remarks' => 'Role which will have all privileges.'
        ]);

        Role::create([
            'id' => 4,
            'name' => 'Editor',
            'remarks' => 'Role which will have all privileges.'
        ]);

        Role::create([
            'id' => 5,
            'name' => 'Author',
            'remarks' => 'Role which will have all privileges.'
        ]);

        Role::create([
            'id' => 6,
            'name' => 'Preference',
            'remarks' => 'Role which will have all privileges.'
        ]);

        Role::create([
            'id' => 7,
            'name' => 'Guest',
            'remarks' => 'Role which will have all privileges.'
        ]);

        //Enable Observer
        Role::setEventDispatcher($eventDispatcher);
    }
}
