@extends('frontend.index')

@section('frontend-content')

<div class="row">

  <h1>{{ $listTitle }}</h1>
  <div class="row">
  {{ $elements->links() }}
  </div>
{{-- <div class="table-count">
  @foreach($elements as $element)
    <figure>
      <a href="{{ route('frontend.singlegame', ['slug'=> $element->slug]) }}">
      <div class="photo">
        <img src="{{ asset('uploads/game')}}/{{ $element->cover }}" alt="{{ $element->name }}" class="img-fluid">
      </div>
    </a>
    </figure>
  @endforeach
</div> --}}
<div class="game-list flex">
  @foreach($elements as $element)
<figure class="singlegame">
<a href="{{ route('frontend.singlegame', ['slug'=> $element->slug]) }}"><div class="cover">

<div class="photo">
  <img src="{{ asset('uploads/game')}}/{{ $element->cover }}" alt="{{ $element->name }}" class="img-fluid">
</div>
<figcaption> {{ $element->title }}</figcaption>
</a>
</figure>
@endforeach
</div>

</div>
<div class="row">
{{ $elements->links() }}
</div>
@endsection
