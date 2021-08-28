<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') != 'production') {
            User::updateOrCreate(
                [
                    'id' => 1,
                ],
                [
                    'name' => 'Admin',
                    'email' => 'admin@finfirst.com',
                    'gender' => 'Male',
                    'password' => Hash::make('finfirst123'),
                    'email_verified_at'=>now(),
                ]);
        }
    }
}
