@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
     <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

	    <!-- Display error messages, if any. -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

	    <!-- Top Bar -->
	    <div class="row">
	      <!-- Page header -->
	      <div class="col-sm-4">
	        <h3>Chart of accounts</h3>
			<hr />
	      </div>

		  <!-- AJAX -->
	      <div class="col-sm-4">
	      </div>

	      <div class="col-sm-4 bg-info-rm nwo-pd-0">
	      </div>
	    </div> <!-- .Top Bar -->


		<!-- If there are no account -->
	    @if (count($accounts) === 0)
		  <div>
	        <span class="">
	         &#x26D4; No accounts found
              <br /><br />
			  Please contact accounts manager.
	        </span>
		  <div>
	    @endif

		<!-- Display the chart of accounts -->
		<div>
		  @foreach ($accounts as $account)
		    {{ $account->name }}
            <br/>
		  @endforeach
		</div>

      </div>

  </div>
</div>
@endsection
