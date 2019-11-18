<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Category::create([
          'name' => 'Dla dwóch graczy',
          'slug' => 'dla-dwoch-graczy'
      ]);
      App\Category::create([
          'name' => 'Dla dzieci',
          'slug' => 'dla-dzieci'
      ]);
      App\Category::create([
          'name' => 'Ekonomiczne',
          'slug' => 'ekonomiczne'
      ]);
      App\Category::create([
          'name' => 'Imprezowe',
          'slug' => 'imprezowe'
      ]);
      App\Category::create([
          'name' => 'Karciane',
          'slug' => 'karciane'
      ]);
      App\Category::create([
          'name' => 'Strategiczne',
          'slug' => 'strategiczne'
      ]);
      App\Category::create([
          'name' => 'Planszowe',
          'slug' => 'planszowe'
      ]);
      App\Category::create([
          'name' => 'Bitewne',
          'slug' => 'bitewne'
      ]);
    }

}
