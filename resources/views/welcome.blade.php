@extends('frontend.index')

@section('frontend-content')

<div class="row">
  @if($posts->count() > 0)
  <h2>Ostatnie artykuły</h2>
  @foreach($posts as $post)
    <div class="col-xs-12">
      <div class="col-xs-6 col-md-3">  <a href="{{ route('frontend.singlepost', ['id'=> $post->id]) }}"><div class="singlepost--welcome" style="background-image: url('{{ asset('uploads/post')}}/{{ $post->cover }}');"></div></a></div>
      <div class="col-xs-6 col-md-9">  <a href="{{ route('frontend.singlepost', ['id'=> $post->id]) }}"><h5>{{ $post->title }}</a></h5><p>{!! str_limit($post->description, 200)!!}</p></div>
    </div>
  @endforeach
@endif

<h2>Ostatnio dodane gry</h2>
<div class="owl-carousel owl-theme">
  @foreach($games as $game)
    <figure class="singlegame">
    <a href="{{ route('frontend.singlegame', ['slug'=> $game->slug]) }}"><div class="cover">

    <div class="photo">
      <img src="{{ asset('uploads/game')}}/{{ $game->cover }}" alt="{{ $game->name }}" class="img-fluid">
    </div>
    <figcaption> {{ $game->title }}</figcaption>
    </a>
    </figure>
  @endforeach
</div>
</div>

@endsection
@section('extra-scripts')
  <script src="{{ asset('/js/owl/owl.carousel.min.js') }}"></script>
  <script>
  $(document).ready(function(){
    $(".owl-carousel").owlCarousel({
          autoplay: true,
          responsive: {
            0: {
              items: 2
            },
            600: {
              items: 3
            },
            950: {
              items: 5
            }
          },
          margin:10,
          loop: true,

        });
  });
  </script>
@endsection
@section('extra-styles')
  <link href="{{ asset('/js/owl/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/js/owl/assets/owl.theme.default.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/js/owl/assets/owl.theme.green.min.css') }}" rel="stylesheet">



  {{-- <link rel="stylesheet" href="http://adultf.ayz.pl/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="http://adultf.ayz.pl/owl/owl.theme.default.min.css">
    <link rel="stylesheet" href="http://adultf.ayz.pl/owl/owl.carousel.min.css">
  <link rel="stylesheet" href="http://adultf.ayz.pl/owl/owl.theme.default.min.css"> --}}
@endsection
