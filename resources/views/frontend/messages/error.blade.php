@extends('frontend.index')

@section('frontend-content')
<div class="row">
  <div class="alert alert-danger" role="alert">
    {{ $error }}
  </div>
</div>
@endsection
