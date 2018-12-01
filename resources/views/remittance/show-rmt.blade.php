@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-primary">
      <div class="panel-heading"><h3><strong>Arghya Praswasti</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <!-- Print -->
	  <p class="hidden-print">
	      <button type="button" class="btn btn-primary" id="id_print_page">Print</button>
	  </p>
	  <hr />

	  <p>
		<img src="/satsang-nepal-logo-2.jpg" style="max-width: 50px; display:block; margin-bottom: 15px;" />
		<p style="primary">
		<strong>
		  Satsang Philanthropy, Satsang Nepal<br />
		  Satsang Mandir,<br />
		  Basundol Chandragiri-2, Kathmandu, Nepal
		</strong>
	  </p>
	  <hr />

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
	        <th>Ritwiki</th>
	        <th>Pranami</th>
	        <th>Swa Awa</th>
	        <th>Ananda bazar</th>
	        <th>Parivrity</th>
	        <th>Misc</th>
	        <th>Utsav</th>
	        <th>Diksha Pranami</th>
	        <th>Acharya Pranami</th>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach ( $remittance->remittance_lines as $remittance_line)
		  <tr>
		    <td>
		      {{ $remittance_line->oblate->person->first_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->person->middle_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->person->last_name }}&nbsp;&nbsp;
		    </td>
		    <td>
		      {{ $remittance_line->oblate->worker->person->first_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->worker->person->middle_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->worker->person->last_name }}&nbsp;&nbsp;
		    </td>
		    <td>{{ $remittance_line->swastyayani }}</td>
		    <td>{{ $remittance_line->istavrity }}</td>
		    <td>{{ $remittance_line->acharyavrity }}</td>
		    <td>{{ $remittance_line->dakshina }}</td>
		    <td>{{ $remittance_line->sangathani }}</td>
		    <td>{{ $remittance_line->ritwiki }}</td>
		    <td>{{ $remittance_line->pranami }}</td>
		    <td>{{ $remittance_line->swastyayani_awasista }}</td>
		    <td>{{ $remittance_line->ananda_bazar }}</td>
		    <td>{{ $remittance_line->parivrity }}</td>
		    <td>{{ $remittance_line->misc }}</td>
		    <td>{{ $remittance_line->utsav }}</td>
		    <td>{{ $remittance_line->diksha_pranami }}</td>
		    <td>{{ $remittance_line->acharya_pranami }}</td>
		  </tr>
	        @endforeach
	      </tbody>
	    </table>
	  </p>

	  <p>
	    Family Code: <strong>{{ $remittance->family->family_code }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    Serial num: <strong>{{ $remittance->remittance_id }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    Submitter: 
	      <strong>
	      {{ $remittance->submitter->person->first_name }}&nbsp;&nbsp;
	      {{ $remittance->submitter->person->middle_name }}&nbsp;&nbsp;
	      {{ $remittance->submitter->person->last_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      </strong>
	    Date: <strong>{{ $remittance->submitted_date }}</strong>&nbsp;&nbsp;
	    Total: <strong>{{ $remTotal }}</strong>
	  </p>
      </div>
  </div>
</div>
@endsection
