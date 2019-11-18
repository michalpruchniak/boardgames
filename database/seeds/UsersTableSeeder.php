<?php

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
      App\User::create([
          'name' => 'Admin',
          'email' => 'goldenofheart@gmail.com',
          'password' => bcrypt('kowal123'),
          'slug' => 'admin',
          'admin' => 1,
          'moderator' => 1,
          'active' => 1,
          'ban' => 0
        ]);
    }
}
