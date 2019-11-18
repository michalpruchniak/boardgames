@extends('frontend.index')

@section('frontend-content')

<div class="row">

  <h1>Najpopularniejsze gry</h1>

      <div class="table-responsive">
      <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Okładka</th>
              <th>Tytuł</th>
              <th>Wydawnictwo</th>
              <th>Projektant</th>
              <th>Kategorie</th>
            </tr>
          </thead>
          <tbody>
            @foreach($elements as $key=>$element)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>  <img src="{{ asset('uploads/game')}}/{{ $element->cover }}" alt="{{ $element->name }}" class="img-fluid cover-ranking"></td>
                <td><a href="{{ route('frontend.singlegame', ['slug' => '']) }}/{{ $element->slug }}">{{ $element->title }}</td>
                <td><a href="{{ route('frontend.publisher', ['slug' => '']) }}/{{ $element->publisher->slug }}">{{ $element->publisher->name }}</a></td>
                <td>
                  @foreach($element->designers as $designer)
                    <a href="{{ route('frontend.designer', ['slug' => '']) }}/{{ $designer->slug }}">{{ $designer->name }}</a><br>
                  @endforeach
                </td>
                <td>
                  @foreach($element->category as $category)
                    <a href="{{ route('frontend.category', ['slug' => '']) }}/{{ $category->slug }}">{{ $category->name }}</a><br>
                  @endforeach
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>


@endsection
