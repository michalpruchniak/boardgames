@extends('frontend.index')

@section('frontend-content')
<div class="row">
  <div class="col-xs-12 col-md-8">
    @yield('post-content')
  </div>
  <div class="hidden-xs hidden-sm col-md-3">
      <div class="row">
      <h5 class="information">Zobacz także</h5>
    </div>
      <div class="row">
        <div class="section">
          <h4>Ostatnie:</h4>
          @foreach($latest as $l)
            <div class="row">
              <div class="col-xs-6">
                <div style="width: 105px; height: 90px; background-size: auto 90px; background-repeat: no-repeat; background-position: center; background-image: url('{{ asset('uploads/post')}}/{{ $l->cover }}');"></div>
                {{-- <div style="width: 100%; height: 80px; background-size: cover; background-image: url({{asset('uploads/post')}}/{{$l->cover}};)"></div> --}}
              </div>
              <div class="col-xs-6">
                <p><a href="{{route('frontend.singlepost', ['id' => $l->id])}}">{{ $l->title }}</a></p>
                <p><small>{!! str_limit($l->description, 38)!!}</small></p>
              </div>
          </div>
          @endforeach
        </div>
      </div>
  </div>
</div>
@endsection
