@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Create new Lot</strong></h3></div>
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

	  <!-- Main part -->
	  <div class="col-md-6 bg-info nwo-std-padding">
            <form action="{{ url('/rmt/lot/create') }}" method="post">
	      {{ csrf_field() }}

              <div class="form-group">
                <label for="bank-deposit-date">Bank Voucher Deposit Date</label>
                <input type="text" class="form-control" id="" name="bank-deposit-date" placeholder="Bank Deposit Date">
              </div>

	      {{--
              <div class="form-group">
                <label for="bank-voucher-number">Bank Voucher number</label>
                <input type="text" class="form-control" id="" name="bank-voucher-number" placeholder="Bank Voucher Number">
              </div>
	      --}}

              <div class="form-group">
                <label for="bank-deposited-by">Bank Deposited By</label>
                <input type="text" class="form-control" id="" name="bank-deposited-by" placeholder="Bank Deposited By">
              </div>

              <div class="form-group">
                <label for="bank-deposit-amount">Bank Deposited Amount</label>
                <input type="text" class="form-control" id="" name="bank-deposit-amount" placeholder="Bank Deposit Amount">
              </div>

	      <hr />

              <div class="form-group">
                <label for="philanthrophy-deposit-date">Philanthrophy Deposit Date</label>
                <input type="text" class="form-control" id="" name="philanthrophy-deposit-date" placeholder="Philanthrophy Deposit Date">
              </div>


              <div class="form-group">
                <label for="philanthrophy-deposited-by">Philanthrophy Deposited By</label>
                <input type="text" class="form-control" id="" name="philanthrophy-deposited-by" placeholder="Philanthrophy Deposited By">
              </div>


              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
	  </div>
      </div>
  </div>
</div>
@endsection
