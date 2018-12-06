@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Confirm Lot Print</strong></h3></div>
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

	  <div>
	    @if (! $rmtLot)
	      Lot not found !
	    @else
	      <p>
	        Lot found !
	      </p>
	      <ul class="lot-list">
	        @foreach ($rmtLot->remittances as $remittance)
                  <li>{{ $remittance->remittance_id }}</li>
		  <!-- For each remittance need to call print remittance -->
	        @endforeach
	      </ul>
	      <p>
	        <button type="button" class="btn btn-primary" id="id_print_lot_btn" >Print</button>
	      </p>
	    @endif
	  </div>
      </div>
  </div>
</div>
@endsection
