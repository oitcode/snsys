<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--
    <style>
      .nwo-padding-0 {
        padding-right: 0;
        padding-left: 0;

	width: 100px !important;
      }

      input {
        display: block !important;
        padding: 0 !important;
	margin: 0 !important;
	border: 0 !important;
	width: 100% !important;
      }

      td {
        margin: 0 !important;
	padding: 0 !important;
	background-color: gray !important;
      }

      td, tr, th {
          border: 1px solid black !important;
      }
      table {
          border-collapse: collapse !important;
      }
    </style>
    -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                      <!-- Remittance -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Remittance <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              <li><a href="{{ url('/rmt/create') }}">Create</a></li>
                              <li><a href="{{ url('/rmt/search') }}">Search</a></li>
                          </ul>
                      </li>

                      <!-- Worker -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Worker <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              <li><a href="">Create</a></li>
                              <li><a href="">Search</a></li>
                          </ul>
                      </li>

                      <!-- Oblate -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Oblate <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              <li><a href="">Create</a></li>
                              <li><a href="">Search</a></li>
                          </ul>
                      </li>

                      <!-- Sangh -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Sangh <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              <li><a href="{{ url('/sangh/family') }}">Family</a></li>
                          </ul>
                      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="">Change password</a></li>
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
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
