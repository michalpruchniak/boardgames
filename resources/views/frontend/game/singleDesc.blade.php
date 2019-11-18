@extends('frontend.game.index')

@section('game-content')
  <div class="row">
{!! $game->description !!}
</div>

@endsection
