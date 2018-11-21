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

          <h5>Bank Voucher info</h5>
          <form action="{{ url('/rmt/create/store') }}" method="post">
	    {{ csrf_field() }}

            <!-- Bank Voucher Info -->
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
                  <td><input type="text" class="nwo-std-frminp" name="bv-num" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp" name="bv-deposit-date" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp" name="bv-depositor" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp" name="bv-amount" id="" /></td>
                </tr>
              </tbody>
            </table>
	    <hr />

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
                  <th>Delivered by</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> 
                    <span style="font-size: 12px;"><strong style="font-size: 11px;"><?php echo date('Y-m-d') . "&nbsp;&nbsp;&nbsp;&nbsp;";  ?></strong></span>
                  </td>
                  <td><input type="text" class="nwo-std-frminp" name="family-code" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="submitter-name" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="submitter-address" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp" name="submitted-date" id="" /></td>
                  <td><input type="text" class="nwo-std-frminp nwo-std-frminp-lx" name="delivered-by" id="" /></td>
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
              <tbody id="item-tbody">
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
