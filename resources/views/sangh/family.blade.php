@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
      <div class="panel-heading"><strong>Family</strong></div>
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
	      <br />
	      <br />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <p>



      </div>
  </div>
</div>
@endsection
