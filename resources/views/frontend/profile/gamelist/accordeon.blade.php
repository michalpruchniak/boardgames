@extends('frontend.profile.index')

@section('profile-content')

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="add-game" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Mam
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        @if($ihave->count() < 1)
          Brak elementów do wyświetlenia
        @else
          <div class="game-list flex">
        @foreach($ihave as $element)
        <figure class="singlegame">
          <a href="{{ route('frontend.singlegame', ['slug'=> $element->Game->slug]) }}"><div class="cover">

          <div class="photo">
            <img src="{{ asset('uploads/game')}}/{{ $element->Game->cover }}" alt="{{ $element->Game->name }}" class="img-fluid">
          </div>
          <figcaption> {{ $element->Game->title }}</figcaption>
        </a>
        </figure>
        @endforeach
      </div>
      @endif
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="add-game" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Grałem\am
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        @if($iplayed->count() < 1)
          Brak elementów do wyświetlenia
        @else
          <div class="game-list flex">
        @foreach($iplayed as $element)
        <figure class="singlegame">
          <a href="{{ route('frontend.singlegame', ['slug'=> $element->Game->slug]) }}"><div class="cover">

          <div class="photo">
            <img src="{{ asset('uploads/game')}}/{{ $element->Game->cover }}" alt="{{ $element->Game->name }}" class="img-fluid">
          </div>
          <figcaption> {{ $element->Game->title }}</figcaption>
        </a>
        </figure>
        @endforeach
      </div>
      @endif
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="WTB">
      <h5 class="mb-0">
        <button class="add-game" type="button" data-toggle="collapse" data-target="#collapseWTB" aria-expanded="false" aria-controls="collapseWTB">
          Chcę kupić
        </button>
      </h5>
    </div>
    <div id="collapseWTB" class="collapse" aria-labelledby="WTB" data-parent="#accordionExample">
      <div class="card-body">
        @if($wtb->count() < 1)
          Brak elementów do wyświetlenia
        @else
          <div class="game-list flex">
        @foreach($wtb as $element)
        <figure class="singlegame">
          <a href="{{ route('frontend.singlegame', ['slug'=> $element->Game->slug]) }}"><div class="cover">

          <div class="photo">
            <img src="{{ asset('uploads/game')}}/{{ $element->Game->cover }}" alt="{{ $element->Game->name }}" class="img-fluid">
          </div>
          <figcaption> {{ $element->Game->title }}</figcaption>
        </a>
        </figure>
        @endforeach
      </div>
      @endif
      </div>
    </div>
  </div>
    <div class="card-header" id="favorite">
      <h5 class="mb-0">
        <button class="add-game" type="button" data-toggle="collapse" data-target="#collapsefavorite" aria-expanded="false" aria-controls="collapsefavorite">
          Ulubione
        </button>
      </h5>
    </div>
    <div id="collapsefavorite" class="collapse" aria-labelledby="favorite" data-parent="#accordionExample">
      <div class="card-body">
        @if($favorite->count() < 1)
          Brak elementów do wyświetlenia
        @else
          <div class="game-list flex">
        @foreach($favorite as $element)
        <figure class="singlegame">
          <a href="{{ route('frontend.singlegame', ['slug'=> $element->Game->slug]) }}"><div class="cover">

          <div class="photo">
            <img src="{{ asset('uploads/game')}}/{{ $element->Game->cover }}" alt="{{ $element->Game->name }}" class="img-fluid">
          </div>
          <figcaption> {{ $element->Game->title }}</figcaption>
        </a>
        </figure>
        @endforeach
      </div>
      @endif
      </div>
    </div>
@endsection
