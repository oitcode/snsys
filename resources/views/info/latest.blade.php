@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Latest Info</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <!-- Display any error messages -->
	  @if ($errors->any())
	    <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
	    </div>
	  @endif

	  <!-- Main display div -->
	  <div>
	    <p>
	      <strong>Maximum Family Code: {{ $maxFamCode }}</strong>
	    <p>
	    <p>
	      <strong>Maximum Serial Num: {{ $maxSerialNum }}</strong>
	    <p>
	  </div>
      </div>
  </div>
</div>
@endsection
