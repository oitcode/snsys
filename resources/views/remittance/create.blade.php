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
                  <td><input type="text" class="nwo-std-frminp" name="submitted-total" id="" value="{{ old('submitted-total') }}"/></td>
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
                  <th>Person</th>
                  <th>Ritwick's full name</th>
                  <th>Swastyayani</th>
                  <th>Istavrity</th>
                  <th>Acharyavriti</th>
                  <th>Dakshina</th>
                  <th>Sangathani</th>
                  <th>Ananda Bazar</th>
                  <th>Pranami</th>
                  <th>Swst aws</th>
                  <th>Ritwiki</th>
                  <th>Utsav</th>
                  <th>Diksha Pr</th>
                  <th>Acharya Pr</th>
                  <th>Parivrity</th>
                  <th>Misc</th>
                </tr>
              </thead>
              <tbody id="remit_row_body">
		<!-- New way: Use 2D Array -->
		<tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[0][name]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[0][ritwik-name]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][swastyayani]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][istavrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][acharyavrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][dakshina]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][sangathani]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][ananda-bazar]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][swastyayani-awasista]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][ritwiki]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][utsav]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][diksha-pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][acharya-pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][parivrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[0][misc]" id="" /></td>
		</tr>
		<tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[1][name]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="remit-row[1][ritwik-name]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][swastyayani]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][istavrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][acharyavrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][dakshina]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][sangathani]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][ananda-bazar]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][swastyayani-awasista]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][ritwiki]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][utsav]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][diksha-pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][acharya-pranami]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][parivrity]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="remit-row[1][misc]" id="" /></td>
		</tr>

		<!--
		Old way of submitting remit lines
		This has 1D array for each of the column
                <tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="person-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="ritwik-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="istavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharyavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="dakshina[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="sangathani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ananda-bazar[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani-awasista[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ritwiki[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="utsav[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="diksha-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharya-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="parivrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="misc[]" id="" /></td>
                </tr>
                <tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="person-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="ritwik-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="istavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharyavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="dakshina[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="sangathani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ananda-bazar[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani-awasista[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ritwiki[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="utsav[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="diksha-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharya-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="parivrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="misc[]" id="" /></td>
                </tr>
                <tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="person-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="ritwik-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="istavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharyavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="dakshina[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="sangathani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ananda-bazar[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani-awasista[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ritwiki[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="utsav[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="diksha-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharya-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="parivrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="misc[]" id="" /></td>
                </tr>
                <tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="person-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="ritwik-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="istavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharyavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="dakshina[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="sangathani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ananda-bazar[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani-awasista[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ritwiki[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="utsav[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="diksha-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharya-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="parivrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="misc[]" id="" /></td>
                </tr>
                <tr>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="person-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx"  name="ritwik-full-name[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="istavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharyavrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="dakshina[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="sangathani[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ananda-bazar[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="swastyayani-awasista[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="ritwiki[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="utsav[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="diksha-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="acharya-pranami[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="parivrity[]" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp"  name="misc[]" id="" /></td>
                </tr>
		-->
                <!-- Additional rows go here -->
              </tbody>
            </table>
            <br />
            <button type="button" onclick="addRow()">+Person</button><br /><br />
            <input type="submit" value="Submit"> <br />
          </form>
      </div>
  </div>
</div>
@endsection
