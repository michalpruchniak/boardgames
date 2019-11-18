@extends('frontend.index')

@section('frontend-content')

<div class="row">
  <div class="row">
    <header class="profileHeader">
        <div class="row">
        <div class="hidden-xs col-sm-2">
          <img src="@if($user->avatar == null) {{ asset('uploads/avatars')}}/default.png @else {{ asset('uploads/avatars')}}/{{ $user->avatar }} @endif" alt="{{ $user->name }}" class="img-fluid">

        </div>
        <div class="col-xs-12 col-sm-8">
          <h1>{{ $user->name }}</h1>
        </div>
    </div>
    <nav class="profile-nav col-xs-12">
      <ul>
        <li @if($activelink == 'description') class="activelink" @endif><a href="{{ route('frontend.mydescription', ['slug' => $user->slug]) }}">Opis</a></li>
        <li @if($activelink == 'mylist') class="activelink" @endif><a href="{{ route('frontend.mylist', ['slug' => $user->slug]) }}">Moja lista</a></li>
      </ul>
    </nav>
    </header>
  </div>
  <div class="row">
    @yield('profile-content')
  </div>
  </div>
@endsection
