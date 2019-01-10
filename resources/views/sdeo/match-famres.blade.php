@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Sdeo Match Result</strong></h3></div>
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

	  <!-- Display match result -->
          <p>
		    <table class="table table-striped table-bordered">
			  <thead>
			  </thead>
			  <tbody>
			    <tr>
				  <th>Family Code</th>
				  <td>{{ $sfamily->sdeo_family_code}}</td>
				</tr>
			    <tr>
				  <th>Address</th>
				  <td>{{ $sfamily->address }}</td>
				</tr>
			  </tbody>
		    </table>
          </p>
		  <p>
			<hr />
		    <h4>Members</h4>
			<hr />
			<ul>
		      @foreach ($spersons as $person)
			    <li>{{ $person->sdeo_person_name }}</li>
			  @endforeach
			</ul>
		  </p>
      </div>
  </div>
</div>
@endsection
