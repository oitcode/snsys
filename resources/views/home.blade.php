@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3>Dashboard</h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <p>
          Welcome to Satsang Nepal application !
	  <p>

	  <p>
          &copy; 2018 Satsang Nepal
	  <p>

      </div>
  </div>
</div>
@endsection
