<?php

use Illuminate\Database\Seeder;

class DesignerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Designer::create([
          'name' => 'Stefan Feld',
          'slug' => 'stefan-feld'
      ]);
    }
}
