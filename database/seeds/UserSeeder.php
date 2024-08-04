<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->delete();

        User::insert([
            // 'id' => 1,
            'name' => 'supuser',
            'email' => 'admin@admin.com',
            'email_verified_at' => NULL,
            'password' => '$2y$10$IaEUlAFiydUPpk6Ywj9Afuw6bqx2cxBrJzOIolhz3NF52CZ2kDIWm',
            'image' => 'unknown.jpg',
            'role' => 0,
            'remember_token' => NULL,
            // 'created_at' => '2021-03-17 07:01:06',
            // 'updated_at' => '2021-03-17 07:01:06',
        ]);
    }
}
