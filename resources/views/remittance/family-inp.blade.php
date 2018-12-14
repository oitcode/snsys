@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Family Input</strong></h3></div>
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

	  <!-- Display search form -->
          <p>
	    {{--
            <form class="form" method="post" action="{{ url('/rmt/search/process') }}">
	    --}}
            <form class="form" method="post" action="{{ url('/rmt/r/familylastr') }}">
	      {{ csrf_field() }}

              <div class="form-group">
                <label for="family-code">Family code</label><br />
                <input type="text" class="form-control" id="id_family_code" name="family-code" placeholder="Family code">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <p>
      </div>
  </div>
</div>
@endsection
