@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Worker Record Display</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <hr />

	  <p>
	    Record as on: {{ $record['todayDate'] }}
	  </p>

	  <hr />

	  <table class="table table-condensed table-striped table-bordered">
	    <thead>
	      <tr>
	        <th>Worker Id</th>
	        <th>Family Code</th>
	        <th>Name</th>
	        <th>Worker Type</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>{{ $record['worker']->worker_id }}</td>
	        <td>{{ $record['family']->family_code }}</td>
	        <td>
	          {{ $record['person']->first_name }}
	          {{ $record['person']->middle_name }}
	          {{ $record['person']->last_name }}
                </td>
	        <td>{{ $record['worker']->type }}</td>
	      </tr>
	    </tbody>
	  </table>

	  <hr />


	  @if (count($record['remittanceLines']) == 0)
	    <p>
	      No records !!!
	    </p>
	  @endif

	  <table class="table table-condensed table-striped table-bordered">
	    <thead>
	      <tr>
	        <th>Date</th>
	        <th>Istavrity</th>
	        <th>Swastyayani</th>
	        <th>Pranami</th>
	        <th>Diksha Pranami</th>
	        <th>Acharya Pranami</th>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach ($record['remittanceLines'] as $remittanceLine)
                <tr>
		  <td>
		    <a href="/rmt/{{ $remittanceLine->remittance->remittance_id }}">
		      {{ $remittanceLine->remittance->remittance_lot->deposit_date }}
		    </a>
		  </td>
		  <td>{{ $remittanceLine->istavrity }}</td>
		  <td>{{ $remittanceLine->swastyayani }}</td>
		  <td>{{ $remittanceLine->pranami }}</td>
		  <td>{{ $remittanceLine->diksha_pranami }}</td>
		  <td>{{ $remittanceLine->acharya_pranami }}</td>
                </tr>
	      @endforeach
	    </tbody>
	  </table>

      </div>
  </div>
</div>
@endsection
