@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
    <div class="panel-heading"><h3><strong>Print Lot</strong></h3></div>
    <div class="panel-body">
      <!-- Display any status messages -->
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
      <div>
        <form class="form-inline" id="id_lot_form" method="get" action="{{ url('/rmt/print/pdf/lot/pdf/prep') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="id_lot_num">Lot number</label><br />
            <input type="text" class="form-control" id="id_lot_num" name="lot-num" placeholder="Lot number" required>
          </div>
          <br />
          <br />
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <!-- .form div ends -->
    </div>
  </div>
</div>
@endsection
