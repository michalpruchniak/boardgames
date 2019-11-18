@extends('panel.index')

@section('admin-content')
  @foreach($blogger as $b)
    <div class="panel panel-default">
      <div class="panel-heading">{{ $b->title }} [{{ $b->user->name}}]</div>
      <div class="panel-body">
        <div class="hello">{!! $b->description !!}</div>
        @if($b->active == 0)
          <a href="{{ route('blogger.activated', ['id' => $b->id]) }}" class="btn btn-success">Zaakceptuj</a>
        @else
          <a href="{{ route('blogger.activated', ['id' => $b->id]) }}" class="btn btn-danger">Usuń akceptację</a>
        @endif
      </div>
    </div>

  @endforeach
  @endsection
  @section('extra-scripts')
    <script src="{{asset('/js/elimore/jquery.elimore.min.js')}}"></script>
    <script>
    $('.hello').elimore({
      maxLength:400
    });
    </script>
    @endsection
