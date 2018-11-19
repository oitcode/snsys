@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
      <div class="panel-heading"><strong>Search Result</strong></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <p>
	    @if (count($remittances) === 0)
	      <span class="alert">
	        No remittances for given family.
	      </span>
	    @endif
	  </p>

	  <p>
	    <table class="table table-striped table-bordered">
	      <thead>
	        <tr class="info">
                  <th>Family Code</th>
                  <th>Serial number</th>
                  <th>Date</th>
                  <th>Action</th>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach ($remittances as $remittance)
		  <tr>
		    <td>{{ $familyCode }}</td>
		    <td>{{  $remittance->remittance_id  }}</td>
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
