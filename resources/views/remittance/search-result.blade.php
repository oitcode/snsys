@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <!--
      <div class="panel-heading"><h3><strong>Search Result</strong></h3></div>
      -->
      <div class="panel-body">
        <h3><strong>Search Result</strong></h3>
	<hr />
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

	  <!-- Show info regarding search query -->
	  <div>
	    <br />
	    @if ($searchBy == 'name')
	      <strong>Name: {{ $searchName }}</strong>
	    @elseif ($searchBy == 'family')
	      <strong>Family Code: {{ $searchFamilyCode }}</strong>
	      @if ($status == 'family_not_found')
	        <p style="color: red;">
		  Family {{ $searchFamilyCode}} does not exist.
	        </p>
	      @endif
	    @elseif ($searchBy == 'lot')
	      <strong>Lot: {{ $searchLotNum }}</strong>
	      @if ($status == 'lot_not_found')
	        <p style="color: red;">
		  Lot {{ $searchLotNum }} does not exist.
	        </p>
	      @endif
	    @elseif ($searchBy == 'serial')
	      <strong>Serial num: {{ $searchSerialNum }}</strong>
	    @elseif ($searchBy == 'none')
	      <strong>Recent 10</strong>
	    @endif
	  </div>
	  <hr />

	  <!-- Display results -->
	  <p>
	    <table class="table table-condensed table-bordered table-hover">
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
		@if ($remittances != null)
	          @foreach ($remittances as $remittance)
		    <tr>
		      <td>{{  $remittance->remittance_id  }}</td>
		      <td>
		      {{ $remittance->family->family_code }}@if($remittance->family->fcode_check_digit !== NULL){{ $remittance->family->fcode_check_digit }}@else N @endif
                      </td>
		      <td>
		        {{ $remittance->submitter->person->first_name }}
		        {{ $remittance->submitter->person->middle_name }}
		        {{ $remittance->submitter->person->last_name }}
		      </td>
		      <td>{{  $remittance->submitted_date  }}</td>
		      <td>
		        <a href="/rmt/{{ $remittance->remittance_id }}">View</a> &nbsp;&nbsp;
		        <a href="">Update</a> &nbsp;&nbsp;
		        <a href="/rmt/delete/{{ $remittance->remittance_id }}">Delete</a>
		      </td>
		    </tr>
	          @endforeach
		@endif
	      </tbody>
	    </table>
	  </p>
      </div>
  </div>
</div>
@endsection
