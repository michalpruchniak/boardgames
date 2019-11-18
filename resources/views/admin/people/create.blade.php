@extends('panel.index')

@section('admin-content')
  <form method="post" action="{{ route('people.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12"><label for="name">Imię i nazwisko</label></div>
        <div class="col-xs-12"><input type="text" name="name"></div>
      </div>
      <div class="row">
        <div class="col-xs-12"><label for="name">Foto</label></div>
        <div class="col-xs-12"><input id="file" type="file" name="file"></div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit">Dodaj</button>

        </div>
      </div>
</form>
@endsection
