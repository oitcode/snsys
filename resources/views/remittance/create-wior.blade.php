@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Create With Old Record</strong></h3></div>
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
	 <hr />


          @if (session('lot'))
	      <p>
	          <strong>
		    Lot Remaining Amount => NC {{ $remainingBal }}
		    &nbsp;&nbsp;&nbsp;&nbsp;
                    ( IC {{ $remainingBal / 1.6 }} )
		  </strong>
	      </p>
	      <hr />
	  @endif


	  <!-- Form -->
          <form action="{{ url('/rmt/create/store') }}" method="post">
	    {{ csrf_field() }}

	    <!-- Currency info -->
            <h4>Currency</h4>
            <div>
              <input type="radio" id="currency-nc" name="currency" value="nc">
              <label for="currency-nc">NRs</label>
              <input type="radio" id="currency-ic" name="currency" value="ic">
              <label for="contactChoice2">IRs</label>
            </div>
	    <hr />

            <!-- Bank Voucher Info -->
            @if (! session('lot'))
              <h4>Bank Voucher info</h4>
              <table class="nwo-form-table" id="bv_table">
                <thead>
                  <tr>
                    <!--<th>Voucher num</th>-->
                    <th>Deposit Date</th>
                    <th>Depositor</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="nwo-std-frminp" name="bv-deposit-date" id="id_bv_date" value="{{ old('bv-deposit-date') }}" /></td>
                    <td><input type="text" class="nwo-std-name nwo-std-frminp" name="bv-depositor" id="id_bv_depositor" value="{{ old('bv-depositor') }}" /></td>
                    <td><input type="number" step="1" min="1" class="nwo-std-frminp" name="bv-amount" id="id_bv_amount" value="{{ old('bv-amount') }}" /></td>
                  </tr>
                </tbody>
              </table>
	      <hr />
            @endif

            <!-- Main Remittance Info -->
            <h4>Main info</h4>
            <table class="nwo-form-table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Family code</th>
                  <th>Person name</th>
                  <th>Person address</th>
                  <th>Submit date</th>
                  <th>Total</th>
		  {{--
                  <th>Delivered by</th>
		  --}}
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> 
                    <span style="font-size: 12px;"><strong style="font-size: 11px;"><?php echo date('Y-m-d') . "&nbsp;&nbsp;&nbsp;&nbsp;";  ?></strong></span>
                  </td>
                  <td><input type="text" class="nwo-std-frminp" name="family-code" id="id_mi_fcode" value="{{ $lastRmt->family->family_code }}{{ $lastRmt->family->fcode_check_digit }}" readonly/></td>
                  <td><input type="text" class="nwo-std-name nwo-std-frminp nwo-std-frminp-lx" name="submitter-name" id="id_mi_sname" value="{{ $lastRmt->submitter->person->first_name }} {{ $lastRmt->submitter->person->middle_name }} {{ $lastRmt->submitter->person->last_name }}"/></td>
                  <td><input type="text" class="nwo-std-upper nwo-std-frminp nwo-std-frminp-lx" name="submitter-address" id="id_mi_saddress" value="{{ $lastRmt->family->address }}"/></td>
                  <td><input type="text" class="nwo-std-frminp" name="submitted-date" id="id_mi_sdate" value="{{ old('submitted-date') }}"/></td>
                  <td><input type="number" step="1" min="1" class="nwo-std-frminp" name="submitted-total" id="id_mi_total" value=""/></td>
                </tr>
              </tbody>
            </table>
            <hr />

            <!-- Remittance Lines -->
            <h4>Breakdown</h4>

	    <!-- Convert to IC button -->
	    <div>
	      <button type="button" class="btn btn-sm btn-primary" id="id_convert_to_ic">Convert to IC</button>
	      <button type="button" class="btn btn-sm" id="id_clear_nums">Clear</button>
	    </div>
	    <br/>


            <table class="nwo-form-table">
              <thead>
                <tr>
                  <th class="nwo-std-10pc nwo-std-smf">Person</th>
                  <th class="nwo-std-10pc nwo-std-smf">Ritwik Name</th>

                  <th class="nwo-std-5pc nwo-std-smf">Swstyani</th>
                  <th class="nwo-std-5pc nwo-std-smf">Istavrity</th>
                  <th class="nwo-std-5pc nwo-std-smf">Acharya vrity</th>
                  <th class="nwo-std-5pc nwo-std-smf">Dkshina</th>
                  <th class="nwo-std-5pc nwo-std-smf">Sngathani</th>
                  <th class="nwo-std-5pc nwo-std-smf">Ritwiki</th>
                  <th class="nwo-std-5pc nwo-std-smf">Pranami</th>
                  <th class="nwo-std-5pc nwo-std-smf">Swst aws</th>
                  <th class="nwo-std-5pc nwo-std-smf">Ananda Bazar</th>
                  <th class="nwo-std-5pc nwo-std-smf">Parivrity</th>
                  <th class="nwo-std-5pc nwo-std-smf">Misc</th>

                  <th class="nwo-std-5pc nwo-std-smf">Utsav</th>
                  <th class="nwo-std-5pc nwo-std-smf">Diksha Pr</th>
                  <th class="nwo-std-5pc nwo-std-smf">Acharya Pr</th>
                </tr>
              </thead>
              <tbody id="remit_row_body">
		<!-- New way: Use 2D Array -->
		@foreach ($lastRmt->remittance_lines as $rl)
		  <tr>
                    <td>
		      <input type="text" class="nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[{{ $loop->index }}][name]" id=""
		        value="{{ $rl->oblate->person->first_name }} {{ $rl->oblate->person->middle_name }} {{ $rl->oblate->person->last_name }}" />
		    </td>
                    <td>
		      <input type="text" class="nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[{{ $loop->index }}][ritwik-name]" id=""
		        value="{{ $rl->oblate->worker->person->first_name }} {{ $rl->oblate->worker->person->middle_name }} {{ $rl->oblate->worker->person->last_name }}" />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][swastyayani]" id=""
		        value="@if ( $rl->swastyayani != 0)
			  {{ $rl->swastyayani }}
			@else
			  Okla 
			@endif
			  " />
	            </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][istavrity]" id=""
		        value="{{ $rl->istavrity }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][acharyavrity]" id=""
		        value="{{ $rl->acharyavrity }}" />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][dakshina]" id=""
		        value="{{ $rl->dakshina }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][sangathani]" id=""
		        value="{{ $rl->sangathani }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][ritwiki]" id=""
		        value="{{ $rl->ritwiki }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][pranami]" id=""
		        value="{{ $rl->pranami }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][swastyayani-awasista]" id=""
		        value="{{ $rl->swastyayani_awasista }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][ananda-bazar]" id=""
		        value="{{ $rl->ananda_bazar }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][parivrity]" id=""
		        value="{{ $rl->parivrity }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][misc]" id=""
		        value="{{ $rl->misc }}"  />
		    </td>

                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][utsav]" id=""
		        value="{{ $rl->utsav }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][diksha-pranami]" id=""
		        value="{{ $rl->diksha_pranami }}"  />
		    </td>
                    <td>
		      <input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[{{ $loop->index }}][acharya-pranami]" id=""
		        value="{{ $rl->acharya_pranami }}"  />
		    </td>
		  </tr>

		@endforeach
                <!-- Additional rows go here -->
              </tbody>
            </table>
            <br />

	    <!-- For multiple months -->
	    <label for="id_for_months">Months</label>
	    <input type="number" min="1" step="1" class="nwo-std-5pc swo-std-frm-inp" id="id_for_months" name="for-months" value="1" required />

	    <!-- Adjust value -->
	    <label for="id_adjust_val">Adjust Value</label>
	    <input type="number" min="0.0" step="0.01" class="nwo-std-5pc swo-std-frm-inp" id="id_adjust_val" name="adjust-val" value="0.0" required />
	    <hr/>

            <!--<button type="button" id="rem_person" class="btn btn-danger">-Person</button>-->
            <button type="button" id="add_person" class="btn btn-primary">+Person</button>
            <!--<button type="button" id="check_total" class="btn btn-danger">Check Total</button>-->
            <input type="submit"  id="submit_remit" class="btn btn-success" value="Submit"> <br />
          </form>
      </div>
  </div>
</div>
@endsection
