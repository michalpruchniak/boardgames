@extends('frontend.index')

@section('frontend-content')
<div class="row">
<div class="col-xs-4 col-md-3">
  <div class="row">
<img src="{{ asset('uploads/game')}}/{{ $game->cover }}" class="img-fluid">
</div>
<div class="row">
  <b>Twoja ocena</b>
  <div id="yourVote" class="rateYo"></div>

</div>
<div class="row">
  <!-- Single button -->
  <div class="btn-group">
    <button type="button" class="dropdown-toggle add-game" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dodaje grę <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      @if(Auth::user())
      <li><a href="{{ route('gamelist.ihave', ['id' => $game->id]) }}">@if($ihave == 1) <i class="fas fa-check"></i> @endif Posiadam</a></li>
      <li><a href="{{ route('gamelist.iplayed', ['id' => $game->id]) }}">@if($iplayed == 1) <i class="fas fa-check"></i> @endif Grałem\am</a></li>
      <li><a href="{{ route('gamelist.iwtb', ['id' => $game->id]) }}">@if($iwtb == 1) <i class="fas fa-check"></i> @endif Chcę kupić</a></li>
      <li><a href="{{ route('gamelist.favorite', ['id' => $game->id]) }}">@if($favorite == 1) <i class="fas fa-check"></i> @endif Ulubione</a></li>
      @else
        <li><a href="/login">Zaloguj się</a></li>
      @endif
    </ul>
  </div>
</div>
</div>
<div class="col-xs-8 col-md-6 singlegame--main-content">
  <div class="row">
    <h1>{{ $game->title }}</h1>
  </div>
  <div class="row"><b>Wydawnictwo:</b> <a href="{{ route('frontend.publisher', ['slug' => $game->publisher->slug]) }}">{{ $game->publisher->name }}</a></div>
  <div class="row">
      <div class="flex">
        <div>
          <div id="avgYo" class="rateYo"></div>
        </div>
        <div>(<a href="{{ route('frontend.singlegameStats', ['slug' => $game->slug]) }}">{{$voteCount}} głosów</a>)</div>
      </div>
  </div>

    @yield('game-content')


</div>

<div class="hidden-xs hidden-sm col-md-3">
  @include('frontend.game.includes.detailsdesktop')
</div>
</div>
@endsection
@section('extra-styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  <script>
  $(function(){
    $("#avgYo").rateYo({
    starWidth: "18px",
    @if($avgVote)
    rating: {{ $avgVote }},
    @endif
    readOnly: true
    })
  });
  @if(Auth::user())
  @if($voted == 0)
  $(function () {

$("#yourVote").rateYo({
  starWidth: "18px",
  fullStar: true
}).on("rateyo.set", function (e, data) {


    $.ajax({
    url         : "{{ route('vote.save', ['game' => '', 'vote' => '']) }}/{{$game->id}}/" + data.rating, //wymagane, gdzie się łączymy
    method      : "get", //typ połączenia, domyślnie get
    contentType : 'application/json', //gdy wysyłamy dane czasami chcemy ustawić ich typ
    dataType    : 'json', //typ danych jakich oczekujemy w odpowiedzi

}).success(
  $.toast({
      heading: 'success',
      text: "Twój głos został zapisany",
      icon: 'success',
      loader: true,        // Change it to false to disable loader
      loaderBg: '#9EC600'  // To change the background
  })
).fail(function(){
  $.toast({
      heading: 'error',
      text: "Twój głos nie może zostać zapisany",
      icon: 'error',
      loader: true,        // Change it to false to disable loader
      loaderBg: '#9EC600'  // To change the background
  })
});
});

});
@else
$(function () {

$("#yourVote").rateYo({
starWidth: "18px",
rating: {{ $yourVote }},
fullStar: true
}).on("rateyo.set", function (e, data) {


  $.ajax({
  url         : "{{ route('vote.update', ['game' => '', 'vote' => '']) }}/{{$game->id}}/" + data.rating, //wymagane, gdzie się łączymy
  method      : "get", //typ połączenia, domyślnie get
  contentType : 'application/json', //gdy wysyłamy dane czasami chcemy ustawić ich typ
  dataType    : 'json', //typ danych jakich oczekujemy w odpowiedzi

}).success(
$.toast({
    heading: 'success',
    text: "Twój głos został zaktualizowany",
    icon: 'success',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600'  // To change the background
})
).fail(function(){
$.toast({
    heading: 'error',
    text: "Twój głos nie może zostać zaktualizowany",
    icon: 'error',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600'  // To change the background
})
});
});

});
@endif
@else
$("#yourVote").rateYo({
  starWidth: "18px",
  fullStar: true
}).on("rateyo.set", function (e, data) {
  $.toast({
      heading: 'information',
      text: "Zaloguj się, żeby oddać głos",
      icon: 'info',
      loader: true,        // Change it to false to disable loader
      loaderBg: '#9EC600'  // To change the background
  })
});
@endif
  </script>
@endsection
