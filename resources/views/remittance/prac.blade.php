@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
      <div class="panel-heading"><strong>Prac</strong></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
      </div>
      <div>
        <p>
	  Name: {{ $name }}<br/>
	  Age: {{ $age }}<br/>
        </p>
      </div>
  </div>
</div>
@endsection
