@extends('panel.index')

@section('admin-content')
  <div class="row">

        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Tytuł</th>
                <th>Edytuj</th>
              </tr>
            </thead>
            <tbody>
              @foreach($games as $element)
                <tr>
                  <td>{{ $element->id }}</td>
                  <td> {{ $element->title }}</td>
                  <td><a href="{{ route('game.edit', ['id' => $element->id]) }}">Edytuj</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
@endsection
