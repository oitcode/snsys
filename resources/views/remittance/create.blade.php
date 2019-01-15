@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Create</strong></h3></div>
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
	      <p>
	          <strong>
		    Bank deposit date  => {{ $bvDepositDate }}
		  </strong>
	      </p>
	      <hr />
	  @endif


	  <!-- Form -->
          <form action="{{ url('/rmt/create/store') }}" method="post" id="ajx-frm">
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
                    <!--<td><input type="text" class="nwo-std-frminp" name="bv-num" id="id_bv_num" value="{{ old('bv-num') }}"/></td>-->
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
                  <td><input type="text" class="nwo-std-frminp" name="family-code" id="id_mi_fcode" value="{{ old('family-code') }}"/></td>
                  <td><input type="text" class="nwo-std-name nwo-std-frminp nwo-std-frminp-lx" name="submitter-name" id="id_mi_sname" value="{{ old('submitter-name') }}"/></td>
                  <td><input type="text" class="nwo-std-upper nwo-std-frminp nwo-std-frminp-lx" name="submitter-address" id="id_mi_saddress" value="{{ old('submitter-address') }}"/></td>
                  <td><input type="text" class="nwo-std-frminp" name="submitted-date" id="id_mi_sdate" value="{{ old('submitted-date') }}"/></td>
                  <td><input type="number" step="1" min="1" class="nwo-std-frminp" name="submitted-total" id="id_mi_total" value="{{ old('submitted-total') }}"/></td>
		  {{--
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="delivered-by" id="id_mi_dname" value="{{ old('delivered-by') }}"/></td>
		  --}}
                </tr>
              </tbody>
            </table>
            <hr />

            <!-- Remittance Lines -->
            <h4>Breakdown</h4>


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
                </tr>
              </thead>
              <tbody id="remit_row_body">
		<!-- New way: Use 2D Array -->
		<tr>
                  <td><input type="text" class="nwo-std-name nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[0][name]" id="" /></td>


<td>
  <select name="choice" class="ajx-rtn-nm">
    @foreach ($ritwiks as $ritwik)
      <option value="{{ $ritwik->first_name }}" class="o-smf">
        {{ $ritwik->person->first_name }}
	@if ($ritwik->person->middle_name != null)
          {{ $ritwik->person->middle_name }}
	@endif
        {{ $ritwik->person->last_name }}
      </option> 
    @endforeach
  </select>
</td>

                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][swastyayani]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][istavrity]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][acharyavrity]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][dakshina]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][sangathani]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][ritwiki]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][pranami]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][swastyayani-awasista]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][ananda-bazar]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][parivrity]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][misc]" id="" /></td>

                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][utsav]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][diksha-pranami]" id="" /></td>
                  <td><input type="number" step="0.25" min="0.0" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][acharya-pranami]" id="" /></td>
		</tr>
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

          <h4>Dynamic</h4>
          <!-- For ajax -->
          <div id="for_ajax">
          </div>
      </div>

  </div>
</div>
@endsection
