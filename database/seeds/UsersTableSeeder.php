<?php

use App\User as Model;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users, User Factory
        $users = factory(App\User::class, 5)->create();

        // Default Admin
        Model::create([
            'first_name' => 'Admin',
            'last_name' => 'Inistrator',
            'address' => 'Pasig City',
            'post_code' => '1606',
            'contact_phone_no' =>'+639123456789',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'user_name' => 'admin101',
            'password' => bcrypt('Password!123'),
            'remember_token' => \Str::random(10),
        ]);




    }
}
