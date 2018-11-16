@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
      <div class="panel-heading"><strong>Search</strong></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif


          <p>
            <form class="form-inline">
              <div class="form-group">
                <label for="familyCode">Family code</label><br />
                <input type="text" class="form-control" id="familyCode" placeholder="Family code">
              </div>
              <div class="form-group">
                <label for="oblateName">Name</label><br />
                <input type="text" class="form-control" id="oblateName" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="remitDate">Date</label><br />
                <input type="text" class="form-control" id="remitDate" placeholder="Date">
              </div>
              <div class="checkbox">
                <label>
		  <br />
                  <input type="checkbox"> Check me out
                </label>
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
