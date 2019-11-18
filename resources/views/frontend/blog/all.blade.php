@extends('frontend.index')

@section('frontend-content')

<div class="row">

  <h1>Wszystkie posty</h1>
  <div class="row">
  {{ $posts->links() }}
  </div>
  <div class="game-list">

    <div class="post-list flex">
      @foreach($posts as $post)
      <div class="singlepost" style="background-image: url('{{ asset('uploads/post')}}/{{ $post->cover }}');">
        <a href="{{ route('frontend.singlepost', ['id'=> $post->id]) }}"><h5>{{ $post->title }}</h5></a>
    </div>
    {{-- </a> --}}
      @endforeach

  </div>
  <div class="row">
  {{ $posts->links() }}
  </div>
</div>
</div>

@endsection
