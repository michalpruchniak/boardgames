<?php

use Illuminate\Database\Seeder;

class ArtistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Artist::create([
          'name' => 'Miguel Coimbra',
          'slug' => 'miguel-coimbra'
      ]);
    }
}
