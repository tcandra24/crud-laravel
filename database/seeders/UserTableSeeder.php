<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $gender = $faker->randomElement(['male', 'female']);
        $role_random = $faker->randomElement(['1', '2', '3']);
        $permissions = Permission::all();

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'gender' => 'male',
            'address' => 'Jl. Jalan',
            'password' => bcrypt('password'),
        ]);

        $role = Role::find(1);

        $role->syncPermissions($permissions);

        $user->assignRole($role);

        for ($i = 0; $i < 100000; $i++) {
            $user = User::create([
                'name' => $faker->name($gender),
                'email' => $faker->email,
                'gender' => $gender,
                'address' => $faker->address,
                'password' => bcrypt('password'),
            ]);

            $role = Role::find($role_random);

            $role->syncPermissions($permissions);

            $user->assignRole($role);
        }

    }
}
