@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong>Done! Istavrity saved.</strong></div>
    <div class="panel-body">
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

	<!-- Show status message -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

	<!-- Show status message -->
        @if (session('serialNum'))
            <div class="alert alert-info">
		<p>
                  Serial number: {{ session('serialNum') }}
		</p>
		<p>
                  Family Code: {{ session('familyCode') }}
		</p>
            </div>
	    <div>
	      <p>
		@if (session('lot'))
		  <a href="/rmt/create" class="btn btn-success btn-sm">
		    Next
		  </a>
		  &nbsp;&nbsp;&nbsp;&nbsp;
                @endif
	        <a href="/rmt/print/pdf/s/p/{{ session('serialNum') }}" target="_blank" class="btn btn-primary btn-sm">
	          Print
	        </a>
	      </p>
	    </div>
        @endif

    </div>
  </div>
</div>
@endsection
