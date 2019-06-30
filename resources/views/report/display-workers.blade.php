@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Worker list</strong></h3></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

	  <!-- Display any error messages -->
	  @if ($errors->any())
	    <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
	    </div>
	  @endif

	  @if (count($workers) != 0)
             
	     <!-- Ritwik -->
	     @php
	      $i = 0;
	     @endphp


	      <table class="table table-condensed table-striped table-bordered">
	        <thead>
		  <tr>
		    <th>SN</th>
		    <th>Worker Id</th>
		    <th>Person Id</th>
		    <th>Oblate Id</th>
		    <th>Family Code</th>
		    <th>Type</th>
		    <th>Name</th>
		    <th>Action</th>
		  </tr>
	        </thead>
	        @foreach ($workers as $worker)
		  @if ($worker->worker_code == 'NR-200001')
		    @php
		      $i++;
		    @endphp
	            <tr>
	              <td>
		        @php
			  echo $i;
		        @endphp
		      </td>
	              <td>{{ $worker->worker_id }}</td>
	              <td>{{ $worker->person->person_id }}</td>
	              <td>{{ $worker->person->oblate()->first()['oblate_id'] }}</td>
	              <td>{{ $worker->person->oblate()->first()['family']['family_code'] }}</td>
	              <td>{{ $worker->type }}</td>
	              <td>
		        {{ $worker->person->first_name }}
		        {{ $worker->person->middle_name }}
		        {{ $worker->person->last_name }}
		      </td>
	              <td>
		        <a href="/report/worker/{{ $worker->worker_id }}">Record</a>
			&nbsp;&nbsp;
		        <a href="">Edit</a>
		      </td>
	            </tr>
		  @endif
	        @endforeach
	      </table>

	     <!-- Jajak -->
	     @php
	      $i = 0;
	     @endphp


	      <table class="table table-condensed table-striped table-bordered">
	        <thead>
		  <tr>
		    <th>SN</th>
		    <th>Worker Id</th>
		    <th>Person Id</th>
		    <th>Oblate Id</th>
		    <th>Family Code</th>
		    <th>Type</th>
		    <th>Name</th>
		    <th>Action</th>
		  </tr>
	        </thead>
	        @foreach ($workers as $worker)
		  @if ($worker->worker_code == 'NJ-300001')
		    @php
		      $i++;
		    @endphp
	            <tr>
	              <td>
		        @php
			  echo $i;
		        @endphp
		      </td>
	              <td>{{ $worker->worker_id }}</td>
	              <td>{{ $worker->person->person_id }}</td>
	              <td>{{ $worker->person->oblate()->first()['oblate_id'] }}</td>
	              <td>{{ $worker->person->oblate()->first()['family']['family_code'] }}</td>
	              <td>{{ $worker->type }}</td>
	              <td>
		        {{ $worker->person->first_name }}
		        {{ $worker->person->middle_name }}
		        {{ $worker->person->last_name }}
		      </td>
	              <td>
		        <a href="/report/worker/{{ $worker->worker_id }}">Record</a>
			&nbsp;&nbsp;
		        <a href="">Edit</a>
		      </td>
	            </tr>
		  @endif
	        @endforeach
	      </table>

	     <!-- Adharjyu -->
	     @php
	      $i = 0;
	     @endphp


	      <table class="table table-condensed table-striped table-bordered">
	        <thead>
		  <tr>
		    <th>SN</th>
		    <th>Worker Id</th>
		    <th>Person Id</th>
		    <th>Oblate Id</th>
		    <th>Family Code</th>
		    <th>Type</th>
		    <th>Name</th>
		    <th>Action</th>
		  </tr>
	        </thead>
	        @foreach ($workers as $worker)
		  @if ($worker->worker_code == 'NA-400001')
		    @php
		      $i++;
		    @endphp
	            <tr>
	              <td>
		        @php
			  echo $i;
		        @endphp
		      </td>
	              <td>{{ $worker->worker_id }}</td>
	              <td>{{ $worker->person->person_id }}</td>
	              <td>{{ $worker->person->oblate()->first()['oblate_id'] }}</td>
	              <td>{{ $worker->person->oblate()->first()['family']['family_code'] }}</td>
	              <td>{{ $worker->type }}</td>
	              <td>
		        {{ $worker->person->first_name }}
		        {{ $worker->person->middle_name }}
		        {{ $worker->person->last_name }}
		      </td>
	              <td>
		        <a href="/report/worker/{{ $worker->worker_id }}">Record</a>
			&nbsp;&nbsp;
		        <a href="">Edit</a>
		      </td>
	            </tr>
		  @endif
	        @endforeach
	      </table>
	  @endif
      </div>
  </div>
</div>
@endsection
