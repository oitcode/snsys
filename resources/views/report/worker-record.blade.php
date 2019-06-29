@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading hidden-print"><h3><strong>Worker Record Display</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <hr />

	  <p>
	    <strong>
	      Record date: {{ $record['todayDate'] }}
	    </strong>
	  </p>

	  <hr />

	  <table class="table table-condensed table-striped table-bordered">
	    <thead>
	      <tr>
	        <th>Worker Id</th>
	        <th>Family Code</th>
	        <th>Name</th>
	        <th>Address</th>
	        <th>Ritwik's Name</th>
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
	        <td>{{ $record['family']->address }}</td>
	        <td>
		  {{ $record['oblate']->worker->person->first_name }}
		  {{ $record['oblate']->worker->person->middle_name }}
		  {{ $record['oblate']->worker->person->last_name }}
		</td>
	        <td>{{ $record['worker']->type }}</td>
	      </tr>
	    </tbody>
	  </table>

	  <hr />


	  <h4>Istavrity and Swastyayani</h4>
	  <table class="table table-condensed table-striped table-bordered">
	    <thead>
	      <tr>
	        <th>Istavrity</th>
	        <th>Num of times</th>
	        <th>Swastyayani</th>
	        <th>Num of times</th>
	      </tr>
	    </thead>
	    <tbody>
        <tr>
          <td>{{ $record['istavrityInfo']['total'] }}</td>
          <td>{{ $record['istavrityInfo']['numOfTimesDeposited'] }}</td>
          <td>{{ $record['swastyayaniInfo']['total'] }}</td>
          <td>{{ $record['swastyayaniInfo']['numOfTimesDeposited'] }}</td>
        </tr>
	    </tbody>
	  </table>

	  <hr />
	  <h4>Worker Deposit</h4>

	  @if (count($record['remittanceLines']) == 0)
	    <p>
	      No records !!!
	    </p>
	  @endif

    <div class="row">
      <!-- Utsav -->
      <div class="col-md-4">
	      <table class="table table-condensed table-striped table-bordered">
	        <thead>
	          <tr>
	            <th>Date</th>
	            <th>Utsav</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($record['remittanceLines'] as $remittanceLine)
		    @if (
		      ($remittanceLine->utsav != null && $remittanceLine->utsav > 0)
		    )
                      <tr>
		        <td>
		          {{ $remittanceLine->remittance->remittance_lot->deposit_date }}
		        </td>
		        <td>{{ $remittanceLine->utsav }}</td>
                      </tr>
		    @endif
	          @endforeach
	        </tbody>
	      </table>
      </div>

    <!-- Diksha Pranami -->
      <div class="col-md-4">
	      <table class="table table-condensed table-striped table-bordered">
	        <thead>
	          <tr>
	            <th>Date</th>
	            <th>Diksha Pranami</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($record['remittanceLines'] as $remittanceLine)
		    @if (
		      ($remittanceLine->diksha_pranami != null && $remittanceLine->diksha_pranami > 0)
		    )
                      <tr>
		        <td>
		          {{ $remittanceLine->remittance->remittance_lot->deposit_date }}
		        </td>
		        <td>{{ $remittanceLine->diksha_pranami }}</td>
                      </tr>
		    @endif
	          @endforeach
	        </tbody>
	      </table>
      </div>
      <div class="col-md-4">
	      <table class="table table-condensed table-striped table-bordered">
	        <thead>
	          <tr>
	            <th>Date</th>
	            <th>Acharya Pranami</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($record['remittanceLines'] as $remittanceLine)
		    @if (
		      ($remittanceLine->acharya_pranami != null && $remittanceLine->acharya_pranami > 0)
		    )
                      <tr>
		        <td>
		          {{ $remittanceLine->remittance->remittance_lot->deposit_date }}
		        </td>
		        <td>{{ $remittanceLine->acharya_pranami }}</td>
                      </tr>
		    @endif
	          @endforeach
	        </tbody>
	      </table>
      </div>
    </div>





      </div>
  </div>
</div>
@endsection
