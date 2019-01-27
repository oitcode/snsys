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
	        <h3>Journal Entry</h3>
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
        <form action="" method="post" id="">
	      {{ csrf_field() }}



            <!-- Main Remittance Info -->
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
                      <th class="col-sm-4">Particulars</th>
                      <th>LF No</th>
                      <th>Dr Acc</th>
                      <th>Dr Amount</th>
                      <th>Cr Acc</th>
                      <th>Cr Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
					    <input
						    type="text"
						    class="nwo-std-frminp"
						    name=""
						    id=""
						    value=""
						/>
					  </td>
                      <td>
					    <input
						    type="text"
							class="nwo-std-frminp"
							name=""
							id=""
							value=""
						/>
				      </td>
					  <td>
					    <input
						    type="text"
							class="nwo-std-frminp"
							name=""
							id=""
							value=""
						/>
					  </td>
					  <td>
					    <input
						    type="text"
							class="nwo-std-frminp"
							name=""
							id=""
							value=""
						/>
					  </td>
					  <td>
					    <input
						    type="text"
							class="nwo-std-frminp"
							name=""
							id=""
							value=""
						/>
					  </td>
					  <td>
					    <input
						    type="text"
							class="nwo-std-frminp"
							name=""
							id=""
							value=""
						/>
					  </td>
                    </tr>
                  </tbody>
                </table>
			  </div>
			  <div class="col-sm-2">
	            <!-- Currency info -->
	            <div class="">
                  <h4>Currency</h4>
                  <div>
                    <input type="radio" id="currency-nc" name="currency" value="nc">
                    <label for="currency-nc">NRs</label>
                    <input type="radio" id="currency-usd" name="currency" value="usd">
                    <label for="contactChoice2">USD</label>
                  </div>
	            </div>
			  </div>
			</div>






            <!-- Remittance Lines -->
            <h4>Breakdown</h4>

			<!-- Toolbar -->
			<div class="bg-alert" style="background-color: #eee; margin-bottom: 10px; padding: 5px; font-size: 10px;">
			  <a href="">Convert</a>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <span id="id_clear_nums">Clear</span>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <span class="" id="add_person">+Person</span>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <span class="" id="">Fetch</span>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <span class="" id="">!Reset</span>
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <a href="">Other</a>
			</div>


            <table class="nwo-form-table">
              <thead>
                <tr>
                  <th class="nwo-std-10pc nwo-std-smf">Person</th>
                  <th class="nwo-std-10pc nwo-std-smf">Ritwik Name</th>

                  <th class="nwo-std-5pc nwo-std-smf">Swst</th>
                  <th class="nwo-std-5pc nwo-std-smf">Ist</th>
                  <th class="nwo-std-5pc nwo-std-smf">Acvt</th>
                  <th class="nwo-std-5pc nwo-std-smf">Dks</th>
                  <th class="nwo-std-5pc nwo-std-smf">Sng</th>
                  <th class="nwo-std-5pc nwo-std-smf">Rit</th>
                  <th class="nwo-std-5pc nwo-std-smf">Pra</th>
                  <th class="nwo-std-5pc nwo-std-smf">Swaw</th>
                  <th class="nwo-std-5pc nwo-std-smf">AB</th>
                  <th class="nwo-std-5pc nwo-std-smf">Pvt</th>
                  <th class="nwo-std-5pc nwo-std-smf">Msc</th>

                  <th class="nwo-std-5pc nwo-std-smf">Uts</th>
                  <th class="nwo-std-5pc nwo-std-smf">Dpr</th>
                  <th class="nwo-std-5pc nwo-std-smf">Apr</th>

                  <th class="nwo-std-5pc nwo-std-smf" style="background-color: aliceblue; color: #888;">---</th>
                </tr>
              </thead>
              <tbody id="remit_row_body">
              </tbody>
            </table>
            <br />
            <input type="submit"  id="submit_remit" class="btn btn-success btn-sm" value="Submit"> <br />
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
