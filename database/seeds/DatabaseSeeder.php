<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'fname' => 'Epic',
            'lname' => 'Corporation',
            'mobile' => '8888888888',
            'email' => 'epic@gmail.com',
            'password' => bcrypt('111111'),
            'role' => 'admin',
            'status' => 1
        ]);
    }
}
