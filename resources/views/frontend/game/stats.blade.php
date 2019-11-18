@extends('frontend.game.index')

@section('game-content')
  <table class="table table-responsive break">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Łęczna liczba wyświetleń</th>
      <th scope="col">Liczba wyświetleń w ostatnich 2 tyodniach</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $visitors }}</td>
      <td>{{ $visitorsTwoWeek }}</td>
    </tr>
  </tbody>
</table>
<div class='col-xs-12 col-md-6'>
<div class="row break">
  <h4>Wszystkie głosy</h4>
    <div class="flex">
      <div>
        <div id="allUsersVote" class="rateYo"></div>
      </div>
      <div>({{$voteCount}} głosów)</div>
    </div>
</div>
</div>
<div class='col-xs-12 col-md-6'>
<div class="row break">
  <h4>Głosy ekspertów</h4>
    <div class="flex">
      <div>
        <div id="expertsVote" class="rateYo"></div>
      </div>
      <div>({{$expertVoteCount}} głosów)</div>
    </div>
</div>
</div>
@endsection
@section('extra-scripts')
  <script>
  $(function(){
    $("#allUsersVote").rateYo({
    starWidth: "18px",
    @if($avgVote)
    rating: {{ $avgVote }},
    @endif
    readOnly: true
  });
    $("#expertsVote").rateYo({
    starWidth: "18px",
    @if($expertVote)
    rating: {{ $expertVote }},
    @endif
    readOnly: true
    })
  });
  </script>
@endsection
