<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create permision list
        $permissions = [
			'user-list',
			'user-create',
			'user-edit',
			'user-delete',

            'role-list',
			'role-create',
			'role-edit',
			'role-delete',

			'permission-list',
			'permission-create',
			'permission-edit',
			'permission-delete',

			'dashboard-list',
			'dashboard-create',
			'dashboard-edit',
			'dashboard-delete',

			'profile-list',
			'profile-create',
			'profile-edit',
			'profile-delete',

            'contact-list',
			'contact-create',
			'contact-edit',
			'contact-delete',

		];

		foreach ($permissions as $permission) {
			Permission::create([
				'name' => $permission
			]);
		}
    }
}
