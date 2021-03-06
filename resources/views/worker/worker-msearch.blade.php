@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Worker Search</strong></h3></div>
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

	  <!-- Display search form -->
          <p>
            <form class="form-inline" method="post" action="/db/worker/msearch/process">
	      {{ csrf_field() }}

              <div class="form-group">
                <label for="serial-num">Worker Id</label><br />
                <input type="text" class="form-control" id="serial-num" name="serial-num" placeholder="Serial num">
              </div>
              <div class="form-group">
                <label for="family-code">Name</label><br />
                <input type="text" class="form-control" id="worker-name" name="worker-name" placeholder="Name">
              </div>
	      <br />
	      <br />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <p>
      </div>
  </div>
</div>
@endsection
