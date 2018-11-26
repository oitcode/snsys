@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Resume Lot</strong></h3></div>
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

	  <!-- Main part -->
	  <div class="col-md-6 bg-info nwo-std-padding">
            <form action="{{ url('/rmt/lot/resume/process') }}" method="post">
	      {{ csrf_field() }}

              <div class="form-group">
                <label for="">Lot Num</label>
                <input type="text" class="form-control" id="" name="lot-code" placeholder="Lot Code">
              </div>


              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
	  </div>
      </div>
  </div>
</div>
@endsection
