@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
    <div class="panel-heading"><h3><strong>Family Search Result</strong></h3></div>
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

        <!-- Display family info -->
        <div>
          <h3>Info</h3>
          <table class="table">
            <tr>
              <td>Family Code</td>
              <td>{{ $family->family_code }}</td>
            </tr>
            <tr>
              <td>Address</td>
              <td>{{ $family->address }} &nbsp;&nbsp;&nbsp;&nbsp;<a href="">Edit</a></td>
            </tr>
          </table>

          <h4>Members</h4>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Action</th>
                <th>Name</th>
                <th>Ritwik</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($family->oblates as $oblate)
                <tr>
                  <td>
                    <a href="/db/edit/person/{{ $oblate->person->person_id }}">Edit</a>
                  </td>
                  <td>
                    {{ $oblate->person->first_name }}
                    @if ($oblate->person->middle_name != null)
                      {{ $oblate->person->middle_name }}
                    @endif
                    {{ $oblate->person->last_name }}
                  </td>
                  <td>
                    {{ $oblate->worker->person->first_name }} 
                    @if ($oblate->worker->person->middle_name != null)
                      {{ $oblate->worker->person->middle_name }}
                    @endif
                    {{ $oblate->worker->person->last_name }}
                  </td>
                </tr>
              @endforeach
            <tbody>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
