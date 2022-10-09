<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User (Admin)
        $user = User::where('email', 'admin@gmail.com')->first();
        if (is_null($user)) {
            $user = User::create([
                'name' => 'Mr Super Admin',
                'email' => 'admin@gmail.com',
                'phone' => '01234567890',
                'is_admin' => '1',
                'password' => bcrypt('abcd1234'),
            ]);
        }

        $roleAdmin           = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $roleStaff           = Role::create(['name' => 'User', 'guard_name' => 'web']);

        $permissions    = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissions);
        $user->assignRole([$roleAdmin->id]);
    }
}
