@extends('panel.index')

@section('admin-content')

    <h3>Avatar</h3>
    <form method="post" action="{{ route('panel.preferences.avatar.store') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12"><label for="name"><img class="avatar" src="@if(Auth::user()->avatar == null) {{ asset('uploads\avatars') }}\default.png @else {{ asset('uploads\avatars')}}\{{Auth::user()->avatar}} @endif"></label></div>
        <div class="col-xs-12">
          <input id="file" type="file" name="file">
          @if ($errors->has('file'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('file') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          @if(Auth::user()->avatar != null)
            <a href="{{route('panel.preferences.avatar.del')}}">Usuń avatar </a>
          @endif
          <button type="submit" class="break">Prześlij avatar</button>

        </div>
      </div>
</form>
<br>
<hr>
<h3>Płeć</h3>
<form method="post" action="{{ route('panel.preferences.gender.check') }}">
  {{ csrf_field() }}
  <input type="radio" name="gender" value=0 id="no-sex" @if(Auth::user()->gender == null) checked @endif><label for="no-sex">Nie chcę podawać</label><br>
  <input type="radio" name="gender" value=1 id="man" @if(Auth::user()->gender == 1) checked @endif><label for="man">Mężczyzna</label><br>
  <input type="radio" name="gender" value=2 id="woman" @if(Auth::user()->gender == 2) checked @endif><label for="woman">Kobieta</label><br>
    @if ($errors->has('gender'))
      <div class="alert alert-danger" role="alert">
        <strong>{{ $errors->first('gender') }}</strong>
      </div>
    @endif
    <button type="submit" class="break">Zatwierdź</button>

</form>
<br>
<hr>
<h3>Data urodzenia</h3>
<form method="post" action="{{ route('panel.preferences.dob.check') }}">
  {{ csrf_field() }}
<input type="text" id="datepicker" name="dob" value="@if(Auth::user()->DOB) {{Auth::user()->DOB}} @endif">
  @if ($errors->has('dob'))
    <div class="alert alert-danger" role="alert">
      <strong>{{ $errors->first('dob') }}</strong>
    </div>
  @endif
  <p>
    <h4>Widoczność</h4>
    <p>
      <input type="radio" value=1 name="dobvisible" id="dob-visible" @if(Auth::user()->dobvisible == 1) checked @endif> <label for="dob-visible">Widoczna</label><br>
      <input type="radio" value=0 name="dobvisible" id="dob-hidden" @if(Auth::user()->dobvisible == 0) checked @endif> <label for="dob-hidden">Niewidoczna</label>
        @if ($errors->has('dobvisible'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('dobvisible') }}</strong>
          </div>
        @endif
    </p>
  </p>
<button type="submit" class="break">Zatwierdź</button>

</form>
<br>
<hr>
<h3>Opis</h3>
<form method="post" action="{{ route('panel.preferences.description.change') }}">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-xs-12">
      <textarea name="description" id="description">{{ Auth::user()->description }}</textarea>
      @if ($errors->has('description'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('description') }}</strong>
        </div>
      @endif
    </div>
  </div>
<button type="submit" class="break">Zatwierdź</button>

</form>
<hr>
<h3>Moja lista</h3>
<p>Wybierz wygląd swojej listy gier.</p>
<form method="post" action="{{ route('panel.preferences.layout.list.update') }}">
  {{ csrf_field() }}
<select name="layout">
  <option value=1>Akordeon</option>
</select>
@if ($errors->has('layout'))
  <div class="alert alert-danger" role="alert">
    <strong>{{ $errors->first('layout') }}</strong>
  </div>
@endif
<p>
  <h4>Widoczność</h4>
  <p>
    <input type="radio" value=1 name="layoutvisible" id="layout-visible" @if(Auth::user()->layoutvisible == 1) checked @endif> <label for="layout-visible">Widoczna</label><br>
    <input type="radio" value=0 name="layoutvisible" id="layout-hidden" @if(Auth::user()->layoutvisible == 0) checked @endif> <label for="layout-hidden">Niewidoczna</label>
      @if ($errors->has('layoutvisible'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('layoutvisible') }}</strong>
        </div>
      @endif
  </p>
</p>
<button type="submit" class="break">Zmień wygląd</button>
</form>
@endsection
@section('extra-scripts')
  <script src="{{ asset('/js/jqui/jquery-ui.min.js') }}"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
    "dateFormat": "yy-mm-dd"
    });
  } );
  </script>

  <script>
  $(document).ready(function() {
  $('#description').summernote({
    height: 300
  });
});
  </script>
@endsection
@section('extra-styles')
  <link href="{{ asset('/js/jqui/jquery-ui.min.css') }}"></link>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

@endsection
