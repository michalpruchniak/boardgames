<table class="table table-dark">
  <tbody>
    <tr>
      <td colspan="2" class="text-center">Informacje postawowe</td>
    </tr>
    <tr class="text-center">
      <td>Wydawca</td>
      <td><a href="{{ route('frontend.publisher', ['slug' => $game->publisher->slug]) }}">{{ $game->publisher->name }}</a></td>
    </tr>
    <tr class="text-center">
      <td>Kategorie</td>
      <td>
        @foreach($game->category as $category)
          <a href="{{ route('frontend.category', ['slug' => $category->slug]) }}">{{$category->name}}</a><br>
        @endforeach
      </td>
    </tr>
    @if($game->players)
      <tr class="text-center">
        <td>Liczba graczy</td>
        <td>{{ $game->players }}</td>
      </tr>
    @endif
    @if($game->time)
      <tr class="text-center">
        <td>Czas gry</td>
        <td>{{ $game->time }} minut</td>
      </tr>
    @endif
    @if($game->age)
      <tr class="text-center">
        <td>Od lat</td>
        <td>{{ $game->age }}</td>
      </tr>
    @endif
      <tr>
        <td colspan="2" class="text-center">Autorzy</td>
      </tr>
      <tr class="text-center">
        <td>Projektant</td>
        <td>
        @foreach($game->designers as $designer)
          <a href="{{ route('frontend.designer', ['slug' => $designer->slug]) }}">{{$designer->name}}</a><br>
        @endforeach
      </td>
      </tr>
      @foreach($game->artist as $artist)
      <tr class="text-center">
        <td>Projekt graficzny</td>
        <td>
            <a href="{{ route('frontend.artist', ['slug' => $artist->slug]) }}">{{$artist->name}}</a><br>
      </td>
      </tr>
      @endforeach
      @if(Auth::user() && (Auth::user()->bloger == 1 || Auth::user()->admin == 1 || Auth::user()->moderator == 1))
      <tr class="text-center">
        <td colspan="2">Panel blogera</td>
      </tr>
      <tr class="text-center">
        <td colspan="2">
          <a href="{{ route('blogger.review.create', ['slug' => $game->id]) }}">Dodaj recenzję tej gry</a><br><a href="{{ route('blogger.post.create') }}">Dodaj wpis</a>
        </td>
      </tr>
      @endif
  </tbody>
</table>
