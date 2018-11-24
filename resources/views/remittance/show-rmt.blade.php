@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Istavrity Detail</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <p>
	    Family Code: <strong>{{ $remittance->family->family_code }}</strong><br/>
	    Serial num: <strong>{{ $remittance->remittance_id }}</strong><br/>
	    Submitter: 
	      {{ $remittance->submitter->person->first_name }} &nbsp;&nbsp;
	      {{ $remittance->submitter->person->last_name }}<br/>
	    Date: {{ $remittance->submitted_date }}<br/>
	    Bank Voucher num: {{ $remittance->remittance_lot->voucher_number }}<br/>
	  </p>
	  <p>
	    <table class="table">
	      <thead>
	        <tr class="info">
	        <th>Name</th>
	        <th>Ritwik name</th>
	        <th>Swastyayani</th>
	        <th>Istavrity</th>
	        <th>Acharyavrity</th>
	        <th>Dakshina</th>
	        <th>Sangathani</th>
	        <th>Ananda bazar</th>
	        <th>Pranami</th>
	        <th>Swa Awa</th>
	        <th>Ritwiki</th>
	        <th>Utsav</th>
	        <th>Diksha Pranami</th>
	        <th>Acharya Pranami</th>
	        <th>Parivrity</th>
	        <th>Misc</th>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach ( $remittance->remittance_lines as $remittance_line)
		  <tr>
		    <td>
		      {{ $remittance_line->oblate->person->first_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->person->last_name }}&nbsp;&nbsp;
		    </td>
		    <td> </td>
		    <td>{{ $remittance_line->swastyayani }}</td>
		    <td>{{ $remittance_line->istavrity }}</td>
		    <td>{{ $remittance_line->acharyavrity }}</td>
		    <td>{{ $remittance_line->dakshina }}</td>
		    <td>{{ $remittance_line->sangathani }}</td>
		    <td>{{ $remittance_line->ananda_bazar }}</td>
		    <td>{{ $remittance_line->pranami }}</td>
		    <td>{{ $remittance_line->swastyayani_awasista }}</td>
		    <td>{{ $remittance_line->ritwiki }}</td>
		    <td>{{ $remittance_line->utsav }}</td>
		    <td>{{ $remittance_line->diksha_pranami }}</td>
		    <td>{{ $remittance_line->acharya_pranami }}</td>
		    <td>{{ $remittance_line->parivrity }}</td>
		    <td>{{ $remittance_line->misc }}</td>
		  </tr>
	        @endforeach
	      </tbody>
	    </table>
	  </p>
      </div>
  </div>
</div>
@endsection
