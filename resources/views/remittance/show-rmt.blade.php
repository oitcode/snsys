@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <!--
      <div class="panel-heading"><h3><strong>Remittance Detail</strong></h3></div>
      -->
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <h3>Remittance Detail</h3>
	  <hr />

	  <!-- Toolbar -->
          <div style="background-color: #eee; margin-bottom: 10px; padding: 0px; font-size: 10px;">
	    <!-- Print -->
	    <p class="hidden-print">
	        <a class="btn btn-secondary" id="id_print_ap">Print</a>
	    </p>
          </div>
	  <hr />


	  <p>
	    <table class="table table-condensed table-striped table-bordered">
	      <thead>
	      </thead>
	      <tbody>
	        <tr>
	          <th class="col-sm-2">Family Code</th>
	          <td>{{ $remittance->family->family_code }}@if($remittance->family->fcode_check_digit !== NULL){{ $remittance->family->fcode_check_digit }}@else N @endif</td>
	        </tr>
	        <tr>
	          <th>Serial Num</th>
	          <td>{{ $remittance->remittance_id }}</td>
	        </tr>
	        <tr>
	          <th>Submitter</th>
	          <td style="color: #444;">
	            {{ $remittance->submitter->person->first_name }}&nbsp;
	            {{ $remittance->submitter->person->middle_name }}&nbsp;
	            {{ $remittance->submitter->person->last_name }}
                  </td>
	        </tr>
	        <tr>
	          <th>Address</th>
	          <td>
	            {{ $remittance->family->address }}
                  </td>
	        </tr>
	        <tr>
	          <th>Date</th>
	          <td>{{ $remittance->submitted_date }}</td>
	        </tr>
	        <tr>
	          <th>Total</th>
	          <td>{{ $remTotal }}</td>
	        </tr>
	      </tbody>
	    </table>
	  </p>
	  <hr />

	  <p>
	    <table class="table table-condensed table-bordered table-hover">
	      <thead>
	        <tr class="info" style="font-size: 12px;">
	          <th>Name</th>
	          <th>Ritwik name</th>
	          <th>Swst</th>
	          <th>Ist</th>
	          <th>Acvt</th>
	          <th>Dks</th>
	          <th>Sng</th>
	          <th>AB</th>
	          <th>Pra</th>
	          <th>Swaw</th>
	          <th>Rit</th>
	          <th>Uts</th>
	          <th>Dpr</th>
	          <th>Apr</th>
	          <th>Pvt</th>
	          <th>Msc</th>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach ( $remittance->remittance_lines as $remittance_line)
		  <tr>
		    <td style="font-size:13px;">
		      {{ $remittance_line->oblate->person->first_name }}
		      {{ $remittance_line->oblate->person->middle_name }}
		      {{ $remittance_line->oblate->person->last_name }}
		    </td>
		    <td style="font-size:13px;">
		      {{ $remittance_line->oblate->worker->person->first_name }}
		      {{ $remittance_line->oblate->worker->person->middle_name }}
		      {{ $remittance_line->oblate->worker->person->last_name }}
		    </td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->swastyayani != null && $remittance_line->swastyayani > 0)
			    {{ $remittance_line->swastyayani }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			    {{ $remittance_line->istavrity }}
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->acharyavrity != null && $remittance_line->acharyavrity > 0)
			    {{ $remittance_line->acharyavrity }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->dakshina != null && $remittance_line->dakshina > 0)
			    {{ $remittance_line->dakshina }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->sangathani != null && $remittance_line->sangathani > 0)
			    {{ $remittance_line->sangathani }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->ananda_bazar != null && $remittance_line->ananda_bazar > 0)
			    {{ $remittance_line->ananda_bazar }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->pranami != null && $remittance_line->pranami > 0)
			    {{ $remittance_line->pranami }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->swastyayani_awasista != null && $remittance_line->swastyayani_awasista > 0)
			    {{ $remittance_line->swastyayani_awasista }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->ritwiki != null && $remittance_line->ritwiki > 0)
			    {{ $remittance_line->ritwiki }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->utsav != null && $remittance_line->utsav > 0)
			    {{ $remittance_line->utsav }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->diksha_pranami != null && $remittance_line->diksha_pranami > 0)
			    {{ $remittance_line->diksha_pranami }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->acharya_pranami != null && $remittance_line->acharya_pranami > 0)
			    {{ $remittance_line->acharya_pranami }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
			  @if ($remittance_line->parivrity != null && $remittance_line->parivrity > 0)
			    {{ $remittance_line->parivrity }}
              @else
			  @endif
			</td>
		    <td class="nwo-sm-num">
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
