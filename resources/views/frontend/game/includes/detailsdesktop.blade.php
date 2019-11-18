<div class="row">
<h5 class="information">Szczegłowe informacje</h5>
</div>
@if(isset($addon))
<div class="row">
  <div class="section">
    <h4>Dodatek do gry:</h4> <a href="{{ route('frontend.singlegame', ['slug' => $addon->slug]) }}">{{ $addon->title }}</a>
  </div>
</div>
@endif
<div class="row">
  <div class="section">
    <h4>Wydawca:</h4> <a href="{{ route('frontend.publisher', ['slug' => $game->publisher->slug]) }}">{{ $game->publisher->name }}</a>
  </div>
</div>
<div class="row">
  <div class="section">
  <h4>Kategorie:</h4>
  @foreach($game->category as $category)
    <a href="{{ route('frontend.category', ['slug' => $category->slug]) }}">{{$category->name}}</a><br>
  @endforeach
</div>
</div>
@if($game->artist->count() > 0)
<div class="row">
  <div class="section">
  <h4>Projektant:</h4>
  @foreach($game->designers as $designer)
    <a href="{{ route('frontend.designer', ['slug' => $designer->slug]) }}">{{$designer->name}}</a><br>
  @endforeach
</div>
</div>
@endif
@if($game->artist->count() > 0)
<div class="row">
  <div class="section">
  <h4>Projekt graficzny:</h4>
  @foreach($game->artist as $artist)
    <a href="{{ route('frontend.artist', ['slug' => $artist->slug]) }}">{{$artist->name}}</a><br>
  @endforeach
</div>
</div>
@endif
@if($game->players)
<div class="row">
  <div class="section">
  <h4>Liczba graczy:</h4> {{ $game->players }}
</div>
</div>
@endif
@if($game->time)
<div class="row">
  <div class="section">
  <h4>Czas gry:</h4> {{ $game->time }} minut
</div>
</div>
@endif
@if($game->age)
<div class="row">
  <div class="section">
  <h4>Od lat:</h4> {{ $game->age }}
</div>
</div>
@endif
@if($game->addition == 1)
<div class="row">
  Dodatek do gry {{ $game->game_id}}
</div>
@endif
@if(Auth::user() && (Auth::user()->bloger == 1 || Auth::user()->admin == 1 || Auth::user()->moderator == 1))
  <div class="row">
    <div class="section">
      <h4>Panel blogera:</h4> <a href="{{ route('blogger.review.create', ['slug' => $game->id]) }}">Dodaj recenzję tej gry</a><br><a href="{{ route('blogger.post.create') }}">Dodaj wpis</a>
    </div>
  </div>
@endif
