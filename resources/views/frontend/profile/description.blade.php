@extends('frontend.profile.index')

@section('profile-content')
@if($user->description)
<h4><b>Opis</b></h4>
<p>{!! $user->description !!}</p>
<br>
@endif
<h4><b>Więej informacji</b></h4>
@if($user->DOB != null && $user->dobvisible == 1)
  <p><b>Data urodzenia:</b> {{ $user->DOB }}</p>
@endif
@if($user->gender != null)
  <p><b>Płeć:</b> @if($user->gender == 1) Mężczyzna @elseif($user->gender == 2) Kobieta @endif</p>
@endif
@if(!($user->DOB != null && $user->dobvisible == 1) && !$user->gender != null)
  <p>Brak danych do wyświetlenia</p>
@endif
@endsection
