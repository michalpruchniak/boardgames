<?php

use Illuminate\Database\Seeder;

class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Publisher::create([
          'name' => 'Rebel',
          'slug' => 'rebel'
      ]);
      App\Publisher::create([
          'name' => 'Galakta',
          'slug' => 'galakta'
      ]);
      App\Publisher::create([
          'name' => 'Portal',
          'slug' => 'portal'
      ]);
    }
}
