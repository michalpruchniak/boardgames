<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@if(isset($maintitle)) {{$maintitle}} @else Planszówki @endif</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('js/toast/jquery.toast.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('styles')
    @yield('extra-styles')
</head>
<body>
  <div class="search-result">
    <div class="games break">
      <h5>Gry</h5>
      <div class="game-list"></div>
    </div>
    <div class="publishers break">
      <h5>Wydawwnictwa</h5>
      <div class="publishers-list"></div>
    </div>
    <div class="designers break">
      <h5>Projektanci</h5>
      <div class="designers-list"></div>
    </div>
    <div class="artists break">

      <h5>Graficy</h5>
      <div class="artists-list"></div>
    </div>
  </div>
    <div id="app">
      <header class="mainHeader"></div>
        <nav class="navbar navbar-default navbar-static-top main-navbar">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      <li><a href="/">Home</a></li>
                      <li><a href="{{ route('frontend.allgames') }}">Wszystkie gry</a></li>

                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Kategorie <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                            <li><a href="{{ route('frontend.category', ['slug' => 'dla-dwoch-graczy']) }}">Dla dwóch graczy</a></li>
                            <li><a href="{{ route('frontend.category', ['slug' => 'dla-dzieci']) }}">Dla dzieci</a></li>
                            <li><a href="{{ route('frontend.category', ['slug' => 'ekonomiczne']) }}">Ekonomiczne</a></li>
                            <li><a href="{{ route('frontend.category', ['slug' => 'imprezowe']) }}">Imprezowe</a></li>
                            <li><a href="{{ route('frontend.category', ['slug' => 'karciane']) }}">Karciane</a></li>
                            <li><a href="{{ route('frontend.category', ['slug' => 'strategiczne']) }}">Strategiczne</a></li>
                            <li><a href="{{ route('frontend.category', ['slug' => 'planszowe']) }}">Planoszowe</a></li>
                          </ul>
                      </li>
                        <li><a href="{{ route('frontend.topgames') }}">Ranking gier</a></li>
                        <li><a href="{{ route('frontend.allposts') }}">Wszystkie posty</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->


                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            {{-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <i class="fas fa-bell"></i> (@if(isset($notificeCount)){{ $notificeCount }}@else 0 @endif) <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu notifications">
                                  @foreach($notifice as $n)
                                    <li><a href="{{ route('notification.comment', ['id' => $n->id, 'comment_id' => $n->comment_id]) }}">{{ $n->content }}</a></li>

                                  @endforeach
                                  <li><a href="{{ route('frontend.mylist', ['slug' => Auth::user()->slug]) }}">Moja lista</a></li>
                                  <li><a href="{{ route('panel.preferences') }}">Preferencje</a></li>
                                  <li><a href="{{ route('panel.changepassword') }}">Zmień hasło</a></li>
                                </ul>
                            </li> --}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                  <li><a href="{{ route('frontend.mylist', ['slug' => Auth::user()->slug]) }}">Moja lista</a></li>
                                  <li><a href="{{ route('panel.preferences') }}">Preferencje</a></li>
                                  <li><a href="{{ route('panel.changepassword') }}">Zmień hasło</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                    <form class="navbar-form navbar-right hidden-xs hidden-sm">
                        <div class="form-group">
                          <input type="text" id="search" class="form-control" placeholder="Wyszukaj">
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <div class="mainContent">
          @yield('content')
        </div>
        <footer class="mainFooter">
          <a href="/sitemap.xml">Mapa strony</a> <i class="fas fa-circle"></i>
          <a href="/artykul/wspolpraca">Współpraca</a> <i class="fas fa-circle"></i>
          <a href="/artykul/regulamin">Regulamin</a> <i class="fas fa-circle"></i>
          <a href="/artykul/kontakt">Kontakt</a>
        </footer>
    </div>

    <!-- Scripts -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toast/jquery.toast.min.js') }}"></script>
    @yield('scripts')
    @yield('extra-scripts')



    @if(Session::has('success'))

      <script>
      // $.toast("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, consequuntur doloremque eveniet eius eaque dicta repudiandae illo ullam. Minima itaque sint magnam dolorum asperiores repudiandae dignissimos expedita, voluptatum vitae velit.")
      $.toast({
          heading: 'success',
          text: "{{ Session::get('success') }}",
          icon: 'success',
          loader: true,        // Change it to false to disable loader
          loaderBg: '#9EC600'  // To change the background
      })
      </script>
    @endif
    @if(Session::has('information'))

      <script>
      // $.toast("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, consequuntur doloremque eveniet eius eaque dicta repudiandae illo ullam. Minima itaque sint magnam dolorum asperiores repudiandae dignissimos expedita, voluptatum vitae velit.")
      $.toast({
        heading: 'Information',
        text: "{{ Session::get('information') }}",
        icon: 'info',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#9EC600'  // To change the background
      })
      </script>
    @endif
    @if(Session::has('error'))

      <script>
      // $.toast("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, consequuntur doloremque eveniet eius eaque dicta repudiandae illo ullam. Minima itaque sint magnam dolorum asperiores repudiandae dignissimos expedita, voluptatum vitae velit.")
      $.toast({
        heading: 'Error',
        text: "{{ Session::get('error') }}",
        icon: 'error',
        loader: true,        // Change it to false to disable loader
        loaderBg: '#9EC600'  // To change the background
      })
      </script>
    @endif
</body>
</html>
