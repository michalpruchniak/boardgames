@extends('panel.index')

@section('admin-content')
  <form method="post" action="{{ route('game.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12"><label for="name">Tytuł</label></div>
        <div class="col-xs-12">
          <input type="text" name="title" value="{{ old('title') }}">
          @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('title') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Opis</label></div>
        <div class="col-xs-12">
          <textarea name="description" id="description">{{ old('description') }}</textarea>
          @if ($errors->has('description'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('description') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Liczba graczy</label></div>
        <div class="col-xs-12">
          <input type="text" name="players" value="{{ old('players') }}">
          @if ($errors->has('players'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('players') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Czas gry</label></div>
        <div class="col-xs-12">
          <input type="text" name="time" value="{{ old('time') }}">
          @if ($errors->has('time'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('time') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Gra od lat</label></div>
        <div class="col-xs-12">
          <input type="text" name="age" value="{{ old('age') }}">
          @if ($errors->has('age'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('age') }}</strong>
            </div>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12"><label for="name">Wydawca</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="publisher">
            @foreach ($publisher as $p)
              @if(old('publisher') == $p->id)
                <option value="{{ $p->id }}" selected>{{ $p->name }}</option>
              @else
                <option value="{{ $p->id }}">{{ $p->name }}</option>

              @endif
            @endforeach
          </select>
          @if ($errors->has('publsher'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('publsher') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Kategoria</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="category[]" multiple="multiple">
          @foreach ($category as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endforeach
          </select>
          @if ($errors->has('category'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('category') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Projektant</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="designer[]" multiple="multiple">
          @foreach ($designer as $person)
            <option value="{{ $person->id }}">{{ $person->name }}</option>
          @endforeach
          </select>
          @if ($errors->has('designer'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('designer') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Projekt graficzny</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="artist[]" multiple="multiple">
          @foreach ($artist as $person)
            <option value="{{ $person->id }}">{{ $person->name }}</option>
          @endforeach
          </select>
          @if ($errors->has('artist'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('artist') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <label><input type="checkbox" name="addition" id="addition"> Dodatek</label>
        </div>
      </div>
      <div class="row" id="additionToGame">
        <div class="col-xs-12"><label for="name">Dodatek do gry</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="game">
            <option value=""></option>
          @foreach ($game as $g)
            <option value="{{ $g->id }}">{{ $g->title }}</option>
          @endforeach
          </select>
        </div>
        @if ($errors->has('game'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('game') }}</strong>
          </div>
        @endif
      </div>
      @if(Auth::user()->admin == 1)
      <div class="row">
        <div class="col-xs-12"><label for="name">Reklama</label></div>
        <div class="col-xs-12">
          <textarea name="ads">{{ old('ads') }}</textarea>
        </div>
        @if ($errors->has('ads'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('ads') }}</strong>
          </div>
        @endif
      </div>
      @endif
      <div class="row">
        <div class="col-xs-12"><label for="name">Okładka</label></div>
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
          <button type="submit">Dodaj</button>

        </div>
      </div>
</form>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <script>

  $(document).ready(function() {
  $('.select2-from').select2();
  $('#additionToGame').hide();

  $('#addition').on('change', function(){
    if( $(this).is(':checked')) {
        $("#additionToGame").show();
    } else {
        $("#additionToGame").hide();
    }
  });
  $('#description').summernote({
    height: 300
  });
});
  </script>
@endsection
@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection
