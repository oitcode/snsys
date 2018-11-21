@extends('layouts.base')

@section('content')
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading"><strong>Done! Istavrity saved.</strong></div>
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
    </div>
  </div>
</div>
@endsection
