@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Panel</a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                @if(Auth::user()->admin)
                  <li><a href="/admin/sitemap">Wygeneruj mapę strony</a></li>
                @endif
                <li><a href="{{ route('panel.preferences') }}">Preferencje</a></li>
                <li><a href="{{ route('panel.changepassword') }}">Zmień hasło</a></li>
                @if(Auth::user()->bloger == 1 || Auth::user()->pubisher == 1 || Auth::user()->admin == 1 || Auth::user()->moderator == 1)
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">Panel blogera<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('blogger.post.create') }}">Dodaj wpis</a></li>
                      </ul>
                  </li>
                @endif
                @if(Auth::user()->moderator)
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dodaj<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('game.list') }}">Lista gier</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('game.create') }}">Grę</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('designer.create') }}">Projektanta</a></li>
                        <li><a href="{{ route('artist.create') }}">Grafika</a></li>
                        <li><a href="{{ route('category.create') }}">Kategorię</a></li>
                        <li><a href="{{ route('publisher.create') }}">Wydawcę</a></li>
                    </ul>
                </li>
              @endif
              @if(Auth::user()->admin || Auth::user()->moderator)
                <li><a href="{{ route('moderator.users.index') }}">Użytkownicy</a></li>

              @endif
              @if(Auth::user()->admin || Auth::user()->moderator)
                <li><a href="{{ route('blogger.allposts') }}">Posty blogerów</a></li>

              @endif
            </ul>
        </div>

    </nav>
            <div class="panel panel-default">
                <div class="panel-heading">@if(isset($panelTitle)) {{ $panelTitle }} @else Panel @endif</div>

                <div class="panel-body">
                  <div class="container">

                  </div>
                    @yield('admin-content')
                </div>
            </div>
    </div>
</div>
@endsection
