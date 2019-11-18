@extends('panel.index')

@section('admin-content')
  <div class="row">

        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nick</th>
                <th>Ranga</th>
                <th>Ban</th>
                <th>Blogger </th>
                <th>Moderator</th>
              </tr>
            </thead>
            <tbody>
              @foreach($elements as $element)
                <tr>
                  <td>{{ $element->id }}</td>
                  <td> {{ $element->name }}</td>
                  <td>
                    @if($element->admin)
                      <b><i class="fas fa-crown"></i> Admin</b>
                    @elseif($element->admin == 0 && $element->moderator == 1)
                      <b><i class="fas fa-user-shield"></i> Moderator</b>
                    @else
                      <b><i class="fas fa-user"></i> User</b>

                    @endif
                  </td>
                  <td>
                      @if($element->ban == 0)
                        <a href="{{ route('moderator.users.banned', ['id' => $element->id]) }}" class="btn-sm btn-danger">zbanuj użytkownika</a>
                      @else
                        <a href="{{ route('moderator.users.banned', ['id' => $element->id]) }}" class="btn-sm btn-info">odbanuj użytkownika</a>

                      @endif
                  </td>

                  <td>
                    @if($element->bloger == 0)
                      <a href="{{ route('moderator.users.makeblogger', ['id' => $element->id]) }}" class="btn-sm btn-success">Uczyń bloggerem</a>
                    @else
                      <a href="{{ route('moderator.users.makeblogger', ['id' => $element->id]) }}" class="btn-sm btn-danger">Usuń bloggera</a>
                    @endif
                  </td>
                  <td>
                    @if($element->moderator == 0)
                      <a href="{{ route('moderator.users.makemoderator', ['id' => $element->id]) }}" class="btn-sm btn-success">Uczyń moderatorem</a>
                    @else
                      <a href="{{ route('moderator.users.makemoderator', ['id' => $element->id]) }}" class="btn-sm btn-danger">Usuń moderatora</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
@endsection
