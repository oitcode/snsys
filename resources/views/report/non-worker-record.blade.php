@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading hidden-print"><h3><strong>Non Worker Record Display</strong></h3></div>
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
	            <th>Oblate Id</th>
	            <th>Family Code</th>
	            <th>Name</th>
	            <th>Address</th>
	            <th>Ritwik's Name</th>
	          </tr>
	        </thead>
	        <tbody>
	          <tr>
	            <td>{{ $record['oblate']->oblate_id }}</td>
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

      </div>
  </div>
</div>
@endsection
