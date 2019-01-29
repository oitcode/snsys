@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
	 <!--
     <div class="panel-heading"><h3><strong>Create</strong></h3></div>
	 -->
     <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

	    <!-- Display error messages, if any. -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

	    <!-- Top Bar -->
	    <div class="row">
	      <!-- Page header -->
	      <div class="col-sm-4">
	        <h3>Add account</h3>
	      </div>

		  <!-- AJAX -->
	      <div class="col-sm-4">
	        <!-- Ajax messages will be put here -->
	        <div id="ajax_msg_div">
	        </div>
	        <!-- Ajax progress bar will be displayed here -->
	        <div id="ajax_pbar_div">
			  <p style="color: orange;">
			    Loading ... please wait
			  </p>
	        </div>
	      </div>

	      <div class="col-sm-4 bg-info-rm nwo-pd-0">
	      </div>
	    </div> <!-- .Top Bar -->


	    <!-- Form -->
        <form action="/account/addacc/process" method="post" id="">
	      {{ csrf_field() }}
            <!-- Main Info -->
            <h4>Main info</h4>
			<!-- Toolbar -->
			<div class="bg-alert" style="background-color: #eee; margin-bottom: 10px; padding: 5px; font-size: 10px;">
			  <span id="id_prev_rmt">Previous</span>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <span id="id_next_rmt">Next</span>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			</div>

			<div class="row">
			  <div class="col-sm-10">
                <table class="table table-striped table-bordered table-condensed pwo-form-table">
                  <thead>
                    <tr>
                      <th class="col-sm-4">Account name</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
					    <input
						    type="text"
						    class="nwo-std-frminp"
						    name="account_name"
						    id=""
						    value=""
						/>
					  </td>
                      <td>
					    <input
						    type="text"
							class="nwo-std-frminp"
							name="remarks"
							id=""
							value=""
						/>
				      </td>
                    </tr>
                  </tbody>
                </table>
			  </div>
			  <div class="col-sm-2">
			  </div>
			</div>

            <br />
            <input type="submit"  id="" class="btn btn-success btn-sm" value="Submit"> <br />
          </form>
      </div>


	<!-- Display front end validaton messages -->
	<div class="alert alert-warning" id="id_err_div">
	    <ul id="fe_cur_err_list" class="nwo-std-padding">
	    </ul>
	    <ul id="fe_bv_err_list" class="nwo-std-padding">
	    </ul>
	    <ul id="fe_mi_err_list" class="nwo-std-padding">
	    </ul>
	    <ul id="fe_rl_err_list" class="nwo-std-padding">
	    </ul>
	    <ul id="total_err_list" class="nwo-std-padding">
	    </ul>
	</div>

  </div>
</div>
@endsection
