@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Remittance Search</strong></h3></div>
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
            <form class="form-inline" method="post" action="/db/remittance/search/process">
	      {{ csrf_field() }}

              <div class="form-group">
                <label for="serial-num">Serial num</label><br />
                <input type="text" class="form-control" id="serial-num" name="serial-num" placeholder="Serial num">
              </div>
	      <!--
              <div class="checkbox">
                <label>
		  <br />
                  <input type="checkbox"> Check me out
                </label>
              </div>
	      -->
	      <br />
	      <br />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <p>
      </div>
  </div>
</div>
@endsection
