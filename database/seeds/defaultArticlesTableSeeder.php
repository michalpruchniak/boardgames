<?php

use Illuminate\Database\Seeder;

class defaultArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\defaultArticles::create([
          'title' => 'Współpraca',
          'content' => '
          <img src="/img/blog.jpg" class="img-responsive-fs" alt="gry planszowe, współpraca z bloggerami"><h2>Współpraca z blogerami</h2><p>Chętnie podejmiemy współpracę z blogerami i vlogerami, których działalność skoncentrowana jest wokół tematyki gier planszowych. Uzyskując status bloggera, możesz dodawać recenzje gier, oraz inne artykuły w jakimś stopniu nawiązujące do tematyki gier planszowych. Teksty te będą jedynie zajawkowe, promujące pełne teksty na Twoim blogu. Każdy z tych tekstów zawiera link do pełnego artykułu, dzięki czemu w prosty sposób możesz wypromować swój blog<h2>Reklama</h2><p>Jesteśmy otwarci na wszelskie formy reklamowania innych stron, blogów, sklepów internetowych, czy produktów związanych z grami planszowymi. Jesteś zainteresowany? Pisz!</p>.
          </p>
          ',
          'slug' => 'wspolpraca'
        ]);
      App\defaultArticles::create([
          'title' => 'Regulamin',
          'content' => '
          <h3>1. Podstawowe definicje</h3>
          <p>1.1 <b>Użytkownik</b> - Zarejestrowana osoba</p>
          ',
          'slug' => 'regulamin'
        ]);
    }
}
