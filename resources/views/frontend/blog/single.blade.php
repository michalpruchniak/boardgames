@extends('frontend.blog.index')

@section('post-content')
      <h1>{{ $post->title }}</h1>
      <p>{!! $post->description !!}</p>
      @if(isset($post->website))
        <p><a href="{{ $post->website }}">{{ $post->website }}</a></p>
      @endif
@endsection
