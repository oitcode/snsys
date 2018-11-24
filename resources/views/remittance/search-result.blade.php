@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Search Result</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <p>
	    @if (count($remittances) === 0)
	      <span class="alert">
	        No remittances found for given search.
	      </span>
	    @endif
	  </p>

	  <p>
	    <table class="table table-striped table-bordered">
	      <thead>
	        <tr class="info">
                  <th>Serial number</th>
                  <th>Family Code</th>
                  <th>Submitted by</th>
                  <th>Date</th>
                  <th>Action</th>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach ($remittances as $remittance)
		  <tr>
		    <td>{{  $remittance->remittance_id  }}</td>
		    <td>{{ $remittance->family->family_code }}</td>
		    <td>
		      {{ $remittance->submitter->person->first_name }}
		      {{ $remittance->submitter->person->last_name }}
		    </td>
		    <td>{{  $remittance->submitted_date  }}</td>
		    <td>
		      <a href="/rmt/{{ $remittance->remittance_id }}">View</a> &nbsp;&nbsp;
		      <a href="">Update</a>
		    </td>
		  </tr>
	        @endforeach
	      </tbody>
	    </table>
	  </p>
      </div>
  </div>
</div>
@endsection
