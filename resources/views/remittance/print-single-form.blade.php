@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Print Single</strong></h3></div>
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
            <form class="form-inline" method="get" action="{{ url('/rmt/print/htm/s/fp/prep') }}">
	      {{ csrf_field() }}

              <div class="form-group">
                <label for="id_lot_num">Serial number</label><br />
                <input type="text" class="form-control" id="id_lot_num" name="serial-num" placeholder="Serial num" required>
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
