@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
      <div class="panel-heading"><strong>Create</strong></div>
      <div class="panel-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif


	  <!-- Main Remittance Info-->
          <p>
            <form class="form-inline">
              <div class="form-group">
                <label for="remitDate">Date</label><br />
                <input type="text" class="form-control" id="remitDate" placeholder="Date">
              </div>
              <div class="form-group">
                <label for="familyCode">Family code</label><br />
                <input type="text" class="form-control" id="familyCode" placeholder="Family code">
              </div>
              <div class="form-group">
                <label for="submitterName">Submitted by</label><br />
                <input type="text" class="form-control" id="submitterName" placeholder="Submitted by">
              </div>
              <div class="checkbox">
                <label>
		  <br />
                  <input type="checkbox"> Check me out
                </label>
              </div>
	      <br />
	      <br />
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <p>

	  <hr />

	  <!-- Remittance Line Info-->
	  <table class="table">
	  <!--<table cellpadding="0" cellspacing="0">-->
	    <thead>
	      <tr>
	        <th>Name</th>
	        <th>Swastyayani</th>
	        <th>Istavrity</th>
	        <th>Acharyavrity</th>
	        <th>Dakshina</th>
	        <th>Sangathani</th>
	        <th>Ananda bazar</th>
	        <th>Pranami</th>
	        <th>Swastyayani Awasista</th>
	        <th>Ritwiki</th>
	        <th>Utsav</th>
	        <th>Dakshina Pranami</th>
	        <th>Parivrity</th>
	        <th>Misc</th>
	      </tr>
	    </thead>
	    <tbody>
	      <!-- Row 1 -->
	      <tr>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
	      </tr>
	      <!-- Row 2 -->
	      <tr>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
		<td>
                  <input type="text" class="" placeholder=".col-xs-2">
		</td>
	      </tr>
	    </tbody>
	  </table>
      </div>
  </div>
</div>
@endsection
