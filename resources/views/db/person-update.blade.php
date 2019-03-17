@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-info">
      <div class="panel-heading"><h3><strong>Update Person</strong></h3></div>
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



          <!-- Related info -->
          <div>
            <h4>{{ $person->oblate->family->family_code }}</h4>
          </div>
          <hr />

	      <!-- Form -->
          <form action="/db/edit/person/p/process" method="post">
	        {{ csrf_field() }}

	    <!-- Datalist used for ritwik list -->
	    <datalist id="id_ritwik_list">
	      @foreach ($ritwiks as $ritwik)
	        <option 
	          @if ($ritwik->middle_name != null)
	            value="{{ $ritwik->first_name }} {{ $ritwik->middle_name }} {{ $ritwik->last_name }}"
	          @else
	            value="{{ $ritwik->first_name }} {{ $ritwik->last_name }}"
	          @endif
	        >
	      @endforeach
	    </datalist>

            <table class="table">
              <thead>
              </thead>
              <tbody>
                <tr>
                  <th>Name</th>
                  <td>
                    <input type="text" class="" name="person-name" id=""
                      @if ($person->middle_name != null)
                        value="{{ $person->first_name}} {{ $person->middle_name}} {{ $person->last_name}}"
                      @else
                        value="{{ $person->first_name}} {{ $person->last_name}}"
                      @endif
                    />
                  </td>
                </tr>
                <tr>
                  <th>Person Id</th>
                  <td>
                    <input type="text" name="person-id" value="{{ $person->person_id}}" readonly />
                  </td>
                </tr>
                <tr>
                  <th>Family Code</th>
                  <td>
                    <input type="text" name="family-code" value="{{ $person->oblate->family->family_code}}" readonly />
                  </td>
                </tr>
                <tr>
                  <th>Ritwik</th>
                  <td>
                    <input type="text" name=""
                      @if ($person->oblate->worker->person->middle_name != null)
                        value="{{ $person->oblate->worker->person->first_name }} {{ $person->oblate->worker->person->middle_name }} {{ $person->oblate->worker->person->last_name }}"
                      @else
                        value="{{ $person->oblate->worker->person->first_name }} {{ $person->oblate->worker->person->last_name }}"
                      @endif
		    />
                  </td>
                </tr>
                <tr>
                  <td>
		    <input type="checkbox" id="id_change_ritwik" name="change_ritwik">
		    <label for="id_change_ritwik">Change ritwik</label>
		  </td>
                  <td>
                    <input type="text" name="correct_ritwik" list="id_ritwik_list" />
                  </td>
                </tr>
                <tr>
                  <th>Comment</th>
                  <td>
                    <textarea type="text" name="comment" value="">{{ $person->comment }}</textarea>
                  </td>
                </tr>
              </tbody>
            </table>
            <input type="submit"  id="" class="btn btn-success" value="Submit"> <br />
          </form>
      </div>
  </div>
</div>
@endsection
