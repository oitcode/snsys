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

          <form action="{{ url('/rmt/create/store') }}" method="post">
	    {{ csrf_field() }}

	    <!-- Currency info -->
            <p>Currency</p>
            <div>
              <input type="radio" id="currency-nc" name="currency" value="nc">
              <label for="currency-nc">NRs</label>
              <input type="radio" id="currency-ic" name="currency" value="ic">
              <label for="contactChoice2">IRs</label>
            </div>
	    <hr />

            <!-- Bank Voucher Info -->
            @if (! session('lot'))
              <h5>Bank Voucher info</h5>
              <table class="nwo-form-table">
                <thead>
                  <tr>
                    <th>Voucher num</th>
                    <th>Deposit Date</th>
                    <th>Depositor</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="nwo-std-frminp" name="bv-num" id="" value="{{ old('bv-num') }}"/></td>
                    <td><input type="text" class="nwo-std-frminp" name="bv-deposit-date" id="" value="{{ old('bv-deposit-date') }}" /></td>
                    <td><input type="text" class="nwo-std-frminp" name="bv-depositor" id="" value="{{ old('bv-depositor') }}" /></td>
                    <td><input type="text" class="nwo-std-frminp" name="bv-amount" id="" value="{{ old('bv-amount') }}" /></td>
                  </tr>
                </tbody>
              </table>
	      <hr />
            @endif

            <!-- Main Remittance Info -->
            <h5>Main info</h5>
            <table class="nwo-form-table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Family code</th>
                  <th>Person name</th>
                  <th>Person address</th>
                  <th>Submit date</th>
                  <th>Total</th>
                  <th>Delivered by</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> 
                    <span style="font-size: 12px;"><strong style="font-size: 11px;"><?php echo date('Y-m-d') . "&nbsp;&nbsp;&nbsp;&nbsp;";  ?></strong></span>
                  </td>
                  <td><input type="text" class="nwo-std-frminp" name="family-code" id="" value="{{ old('family-code') }}"/></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="submitter-name" id="" value="{{ old('submitter-name') }}"/></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="submitter-address" id="" value="{{ old('submitter-address') }}"/></td>
                  <td><input type="text" class="nwo-std-frminp" name="submitted-date" id="" value="{{ old('submitted-date') }}"/></td>
                  <td><input type="text" class="nwo-std-frminp" name="submitted-total" id="head_total" value="{{ old('submitted-total') }}"/></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="delivered-by" id="" value="{{ old('delivered-by') }}"/></td>
                </tr>
              </tbody>
            </table>
            <hr />

            <!-- Remittance Lines -->
            <h5>Breakdown</h5>
            <table class="nwo-form-table">
              <thead>
                <tr>
                  <th class="nwo-std-10pc nwo-std-smf">Person</th>
                  <th class="nwo-std-10pc nwo-std-smf">Ritwik Name</th>
                  <th class="nwo-std-5pc nwo-std-smf">Swastyayani</th>
                  <th class="nwo-std-5pc nwo-std-smf">Istavrity</th>
                  <th class="nwo-std-5pc nwo-std-smf">Acharyavrity</th>
                  <th class="nwo-std-5pc nwo-std-smf">Dakshina</th>
                  <th class="nwo-std-5pc nwo-std-smf">Sangathani</th>
                  <th class="nwo-std-5pc nwo-std-smf">Ananda Bazar</th>
                  <th class="nwo-std-5pc nwo-std-smf">Pranami</th>
                  <th class="nwo-std-5pc nwo-std-smf">Swst aws</th>
                  <th class="nwo-std-5pc nwo-std-smf">Ritwiki</th>
                  <th class="nwo-std-5pc nwo-std-smf">Utsav</th>
                  <th class="nwo-std-5pc nwo-std-smf">Diksha Pr</th>
                  <th class="nwo-std-5pc nwo-std-smf">Acharya Pr</th>
                  <th class="nwo-std-5pc nwo-std-smf">Parivrity</th>
                  <th class="nwo-std-5pc nwo-std-smf">Misc</th>
                </tr>
              </thead>
              <tbody id="remit_row_body">
		<!-- New way: Use 2D Array -->
		<tr>
                  <td><input type="text" class="nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[0][name]" id="" /></td>
                  <td><input type="text" class="nwo-std-10pc nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[0][ritwik-name]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][swastyayani]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][istavrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][acharyavrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][dakshina]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][sangathani]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][ananda-bazar]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][swastyayani-awasista]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][ritwiki]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][utsav]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][diksha-pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][acharya-pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][parivrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-5pc nwo-std-frminp col-val"  name="remit-row[0][misc]" id="" /></td>
		</tr>
                <!-- Additional rows go here -->
              </tbody>
            </table>
            <br />
            <!--<button type="button" id="rem_person" class="btn btn-danger">-Person</button>-->
            <button type="button" id="add_person" class="btn btn-primary">+Person</button>
            <button type="button" id="check_total" class="btn btn-danger">Check Total</button>
            <input type="submit"  id="submit_remit" class="btn btn-success" value="Submit"> <br />
          </form>
      </div>
  </div>
</div>
@endsection
