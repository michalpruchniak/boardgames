@extends('frontend.game.index')

@section('game-content')
  <div class="row">
    <h4><b><a href="{{ route('frontend.mydescription', ['id' => $comment->user->slug]) }}" style="@if($comment->user->publisher==1) color:#e80707; @endif @if($comment->user->moderator==1) color:#127FAA; @endif @if($comment->user->admin==1) color:green; @endif">{{ $comment->user->name}}</a></b><small> {{ $comment->updated_at->diffForHumans() }}</small></h4>
<p>{!! $comment->comment !!}</p>
</div>
<div class="row">
  <h4><b>Dodaj komentarz</b></h4>

@if(Auth::user())
<form action="{{ route('frontend.response.store', ['id' => $comment->id])}}" method="post">
  {{ csrf_field() }}
    <textarea name="comment" id="comment">{{ old('comment') }}</textarea>
    <button type="submit">dodaj</button>
</form>
@else
    <div class="alert alert-danger" role="alert">
      Nie jesteś zalogoany. Żeby komentować, <a href="/login">zaloguj się</a> lub <a href="/register">załóż nowe konto</a>.
    </div>

@endif
</div>
  @foreach($response as $comment)
    <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        @if(Auth::user() && (Auth::user()->moderator == 1 || Auth::user()->admin == 1))
          <a href="{{ route('moderator.delcomment', ['id' => $comment->id]) }}" class="btn-sm btn-danger">X</a>
          <a href="{{ route('moderator.users.banned', ['id' => $comment->user->id]) }}" class="btn-sm btn-danger">zbanuj użytkownika</a>
        @endif
        <div class="row break">
          <div class="col-sm-4 col-md-3 hidden-xs">
            <img src="@if($comment->user->avatar == null) {{ asset('uploads/avatars')}}/default.png @else {{ asset('uploads/avatars')}}/{{ $comment->user->avatar }} @endif" alt="{{ $comment->user->name }}" class="img-fluid">
          </div>
          <div class="col-xs-12 col-sm-8 col-md-9">
            <h4 class="username"><b><a href="{{ route('frontend.mydescription', ['id' => $comment->user->slug]) }}" style="@if($comment->user->publisher==1) color:#e80707; @endif @if($comment->user->moderator==1) color:#127FAA; @endif @if($comment->user->admin==1) color:green; @endif">{{ $comment->user->name}}</a></b> <small>{{ $comment->updated_at->diffForHumans() }}</small></h4>
            {!! str_limit($comment->comment, 100) !!}
         </div>
      </div>
    </div>
  </div>
</div>
  @endforeach
@endsection
@section('extra-scripts')
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <script>
  $(function(){
  $('#comment').summernote({
    height: 150,
    toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['height', ['height']]
  ]
  });
});
  </script>
@endsection
@section('styles')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection
