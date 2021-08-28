<?php


namespace Database\Seeders;


use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'label' => 'Admin',
            ]);
        Role::updateOrCreate(
            [
                'id' => 2,
            ],
            [
                'label' => 'Guest',
            ]);
        UserRole::updateOrCreate(
            [
                'user_id' => 1,
            ],
            [
                'user_id' => 1,
                'role_id' => 1,
            ]);
    }
}
