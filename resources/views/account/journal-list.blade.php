@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
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
	        <h3>Journal Entries</h3>
			<hr />
	      </div>

		  <!-- AJAX -->
	      <div class="col-sm-4">
	      </div>

	      <div class="col-sm-4 bg-info-rm nwo-pd-0">
	      </div>
	    </div> <!-- .Top Bar -->


		<!-- If there are no journal entries -->
	    @if (count($jEntries) === 0)
		  <div>
	        <span class="">
	          &#x26D4; No journal entry found
	        </span>
		  <div>
	    @endif

		<!-- Display the journal entries -->
		<div>
		  <table class="table table-condensed table-striped table-bordered">
		    <thead>
			  <tr class="info">
			    <th>SN</th>
			    <th>Particulars</th>
			    <th>Debit Acc</th>
			    <th>Amount</th>
			    <th>Credit Acc</th>
			    <th>Amount</th>
			  </tr>
		    </thead>
		    <tbody>
		      @foreach ($jEntries as $jEntry)
			    <tr>
				  <td>{{ $jEntry->journal_entry_id }}</td>
				  <td>{{ $jEntry->particulars }}</td>
				  <td>{{ $jEntry->dr_account->name }}</td>
				  <td>{{ $jEntry->dr_amount }}</td>
				  <td>{{ $jEntry->cr_account->name }}</td>
				  <td>{{ $jEntry->cr_amount }}</td>
			    </tr>
		      @endforeach
		    </tbody>
		    <tfoot>
		    </tfoot>
		  </table>
		</div>

      </div>

  </div>
</div>
@endsection
