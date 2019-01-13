@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Remittance Detail</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <!-- Print -->
	  <p class="hidden-print">
	      <button type="button" class="btn btn-secondary" id="id_print_page">Print</button>
	      <a href="{{ url('/rmt/print/' . $remittance->remittance_id) }}" class="btn btn-secondary" id="id_print_ap">Print AP</a>
	  </p>
	  <hr />


	  <p>
	    <table class="table table-condensed table-striped table-bordered table-hover">
	      <thead>
	      </thead>
	      <tbody>
	        <tr>
	          <th>Family Code</th>
	          <td>{{ $remittance->family->family_code }}@if($remittance->family->fcode_check_digit !== NULL){{ $remittance->family->fcode_check_digit }}@else N @endif</td>
	        </tr>
	        <tr>
	          <th>Serial Num</th>
	          <td>{{ $remittance->remittance_id }}</td>
	        </tr>
	        <tr>
	          <th>Submitter</th>
	          <td>
	            {{ $remittance->submitter->person->first_name }}&nbsp;
	            {{ $remittance->submitter->person->middle_name }}&nbsp;
	            {{ $remittance->submitter->person->last_name }}
              </td>
	        </tr>
	        <tr>
	          <th>Date</th>
	          <td>{{ $remittance->submitted_date }}</td>
	        </tr>
	        <tr>
	          <th>Total</th>
	          <td>{{ $rmtTotal }}</td>
	        </tr>
	      </tbody>
	    </table>
	  </p>

	  <p>
	    <table class="table table-striped table-condensed table-bordered table-hover">
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
		    <td style="font-size:13px;">
		      {{ $remittance_line->oblate->person->first_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->person->middle_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->person->last_name }}&nbsp;&nbsp;
		    </td>
		    <td style="font-size:13px;">
		      {{ $remittance_line->oblate->worker->person->first_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->worker->person->middle_name }}&nbsp;&nbsp;
		      {{ $remittance_line->oblate->worker->person->last_name }}&nbsp;&nbsp;
		    </td>
		    <td>
			  @if ($remittance_line->swastyayani != null && $remittance_line->swastyayani > 0)
			    {{ $remittance_line->swastyayani }}
              @else
			  @endif
			</td>
		    <td>
			    {{ $remittance_line->istavrity }}
			</td>
		    <td>
			  @if ($remittance_line->acharyavrity != null && $remittance_line->acharyavrity > 0)
			    {{ $remittance_line->acharyavrity }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->dakshina != null && $remittance_line->dakshina > 0)
			    {{ $remittance_line->dakshina }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->sangathani != null && $remittance_line->sangathani > 0)
			    {{ $remittance_line->sangathani }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->ananda_bazar != null && $remittance_line->ananda_bazar > 0)
			    {{ $remittance_line->ananda_bazar }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->pranami != null && $remittance_line->pranami > 0)
			    {{ $remittance_line->pranami }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->swastyayani_awasista != null && $remittance_line->swastyayani_awasista > 0)
			    {{ $remittance_line->swastyayani_awasista }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->ritwiki != null && $remittance_line->ritwiki > 0)
			    {{ $remittance_line->ritwiki }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->utsav != null && $remittance_line->utsav > 0)
			    {{ $remittance_line->utsav }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->diksha_pranami != null && $remittance_line->diksha_pranami > 0)
			    {{ $remittance_line->diksha_pranami }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->acharya_pranami != null && $remittance_line->acharya_pranami > 0)
			    {{ $remittance_line->acharya_pranami }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->parivrity != null && $remittance_line->parivrity > 0)
			    {{ $remittance_line->parivrity }}
              @else
			  @endif
			</td>
		    <td>
			  @if ($remittance_line->misc != null && $remittance_line->misc > 0)
			    {{ $remittance_line->misc }}
              @else
			  @endif
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
