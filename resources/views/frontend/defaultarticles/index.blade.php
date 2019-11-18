@extends('frontend.index')

@section('frontend-content')
<div class="row">
    <h1>{{ $description->title }}</h1>
    <p>{!! $description->content !!}</p>
</div>
@endsection
