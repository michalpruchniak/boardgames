@extends('panel.index')

@section('admin-content')
  <form method="post" action="{{ route('game.update', ['id' => $editgame->id]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12"><label for="name">Tytuł</label></div>
        <div class="col-xs-12">
          <input type="text" name="title" value="{{ $editgame->title }}">
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
          <textarea name="description" id="description">{{ $editgame->description }}</textarea>
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
          <input type="text" name="players" value="{{ $editgame->players }}">
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
          <input type="text" name="time" value="{{ $editgame->time }}">
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
          <input type="text" name="age" value="{{ $editgame->age }}">
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
              @if($editgame->publisher_id == $p->id)
                <option value="{{ $p->id }}" selected>{{ $p->name }}</option>
              @else
                <option value="{{ $p->id }}">{{ $p->name }}</option>

              @endif
            @endforeach
          </select>
          @if ($errors->has('publisher'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('publisher') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="row">

        <div class="col-xs-12"><label for="name">Kategoria</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="category[]" multiple="multiple">
          @foreach ($category as $c)
            @foreach($editgame->category as $c1)
              @if($c->id == $c1->id)
                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
              @else
                <option value="{{ $c->id }}">{{ $c->name }}</option>
              @endif
            @endforeach
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
            @foreach($editgame->designers  as $person1)
              @if($person->id == $person1->id)
                <option value="{{ $person->id }}" selected>{{ $person->name }}</option>
              @else
                <option value="{{ $person->id }}">{{ $person->name }}</option>
              @endif
            @endforeach
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
            @foreach($editgame->artist  as $person1)
              @if($person->id == $person1->id)
                <option value="{{ $person->id }}" selected>{{ $person->name }}</option>
              @else
                <option value="{{ $person->id }}">{{ $person->name }}</option>
              @endif
            @endforeach
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
          <label><input type="checkbox" name="addition" id="addition" @if($editgame->addition == 1) checked @endif> Dodatek</label>
        </div>
      </div>
      <div class="row" @if($editgame->addition < 1) id="additionToGame" @endif>
        <div class="col-xs-12"><label for="name">Dodatek do gry</label></div>
        <div class="col-xs-12">
          <select class="select2-from" name="game">
            <option value=""></option>
          @foreach ($game as $g)
            @if($editgame->game_id == $g->id)
              <option value="{{ $g->id }}" selected>{{ $g->title }}</option>
            @else
              <option value="{{ $g->id }}">{{ $g->title }}</option>
            @endif
          @endforeach
          </select>
        </div>
        @if ($errors->has('game'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('game') }}</strong>
          </div>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Reklama</label></div>
        <div class="col-xs-12">
          <textarea name="ads" id="ads">{{ $editgame->ads }}</textarea>
        </div>
        @if ($errors->has('ads'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('ads') }}</strong>
          </div>
        @endif
      </div>
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
