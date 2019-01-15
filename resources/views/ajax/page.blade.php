@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Ajax</strong></h3></div>
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

	  <form action="/ajax/page/process" method="post" id="id_ajax_form">
	    <label for="">Name</label>
	    <input type="text" name="frm_name" id="name_id" />
	    <input type="button" class="btn btn-primary" id="id_ajax_btn" value="Ajax" />
	  </form>
	  <!-- Ajax button -->

	  <hr/>
	  <h4>Available names</h4>
	  <hr/>

	  <!-- Ajax msg displayed here -->
	  <div id="id_ajax_msg">
	  </div>
      </div>
  </div>
</div>
@endsection
