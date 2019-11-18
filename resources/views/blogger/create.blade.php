@extends('panel.index')

@section('admin-content')
  @if(isset($id))
    <h1>{{ $game->title }}</h1>

    <form method="post" action=" {{route('blogger.review.store', ['id' => $id]) }} " enctype="multipart/form-data">
  @else
    <form method="post" action=" {{route('blogger.post.store') }} " enctype="multipart/form-data">
  @endif
  @if(!isset($id))
    <div class="alert alert-info" role="alert">
      <p>Uwaga! W tym miejscu <u>nie należy</u> zamieszczać recenzji. Jeśli zamierzasz zrecenzować jakiś tytuł, znajdź go na portalu i wybierz <b>dodaj recenzję tej gry</b> w panelu blogera. W tym miejscu można umieszczać ogólne przemyślenia na temat gier planszowych i tematów pokrewnych, relacje z imprez i wszystkie inne treści, które nie są recenzjami.</p>
    </div>
  @endif
  <form method="post" action=" {{route('blogger.post.store') }} ">
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
        <div class="col-xs-12"><label for="name">Treść wpisu</label></div>
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
        <div class="col-xs-12"><label for="name">Adres wpisu</label></div>
        <div class="col-xs-12">
          <input type="text" name="website" value="{{ old('website') }}">
          @if ($errors->has('website'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('website') }}</strong>
            </div>
          @endif
        </div>
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
