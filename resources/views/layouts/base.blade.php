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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
      .nwo-std-frminp {
          /*width: 100px;*/
          /*background-color: red;*/
	  font-family: monospace !important;
	  border: none !important;
      }
      
      .nwo-std-frminp-lx {
        /*width: 200px;*/
      }

      .nwo-form-table thead {
        background-color: #678;
        color: #fafafa;
        padding-top: 20px;
        padding-bottom: 20px;
      }
      
      .nwo-form-table thead th, 
      .nwo-form-table tfoot th {
        font-family: 'Rock Salt', cursive;
      }
      
      .nwo-form-table th {
        /*letter-spacing: 2px; */
        padding:5px;
      }
      
      .nwo-form-table td {
        /* letter-spacing: 1px; */
      }
      
      .nwo-form-table tbody td {
        text-align: left;
      }
      
      .nwo-form-table tfoot th {
        text-align: right;
      }
      
      .nwo-form-table thead {
        /*background: url(leopardskin.jpg);*/
        color: white;
        /* text-shadow: 1px 1px 1px black; */
      }
      .nwo-form-table tfoot {
        /*background: url(leopardskin.jpg);*/
        /* color: black;*/
        /* text-shadow: 1px 1px 1px black; */
      }
      
      .nwo-form-table thead th,
      .nwo-form-table tfoot th,
      .nwo-form-table tfoot td,
      .nwo-form-table tbody td {
	/*
        background: linear-gradient(to bottom, rgba(123,0,0,0.2), rgba(0,0,0,0.5));
	*/
        border: 0.5px solid #aaa;
      }
      
      table.nwo-form-table {
        font-size: 12px;
        /*background-color: #ff33cc;*/
        width: 1000px;
        border-collapse: collapse;
      }
    </style>
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
		    <!-- Todo: brand image final -->
                    <a class="navbar-brand" href="{{ url('/') }}">
		        <img src="/ap1-logo.png" style="max-width: 30px; display: inline; margin-top: -10px;" />
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
                              <li><a href="{{ url('/rmt/r/familyinp') }}">Create</a></li>
                              <li><a href="{{ url('/rmt/search') }}">Search</a></li>
                          </ul>
                      </li>

                      <!-- Lot -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Lot <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              @if (session('lot'))
                                <li><a href="{{ url('/rmt/lot/exit') }}">Exit Lot</a></li>
                              @else
                              <li><a href="{{ url('/rmt/lot/start') }}">Start Lot</a></li>
                              <li><a href="{{ url('/rmt/lot/resume') }}">Resume Lot</a></li>
                              @endif
                          </ul>
                      </li>

		      <!-- Print -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Print <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ url('/rmt/print/pdf/lot/form') }}">Lot</a></li>
                            <li><a href="{{ url('/rmt/print/pdf/single/form') }}">Single</a></li>
                          </ul>
                      </li>

		      <!-- DB -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              DB <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="">Family</a></li>
                            <li><a href="">Remittance</a></li>
                          </ul>
                      </li>


		      <!-- Other -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                              Other <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                            <li><a href="{{ url('/rmt/create') }}">Old Create</a></li>
                            <li><a href="{{ url('/info/latest') }}">Latest Info</a></li>
                            <li><a href="{{ url('/sdeo/faminp') }}">Match</a></li>
                            <li><a href="/ajax/page">Ajax</a></li>
                          </ul>
                      </li>

		      {{-- DO NOT SHOW WOKER, OBLATE AND SANGH
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
		    --}}

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
                                    <li><a href="{{ url('/ol/changepw') }}">Change password</a></li>
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

	<!-- Display Lot information if any -->
        @if (session('lot'))
            <div class="alert alert-danger hidden-print">
                Lot num: {{ session('lot') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/rem-create.js') }}"></script>
    <script src="{{ asset('js/rem-print.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
</body>
</html>
