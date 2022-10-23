@extends('layouts.master')
@include('layouts.app')
@section('content')
<div class="container">
<div id="viewport">
	<header><h1>Acme Clinic</h1></header>
	<img src="{{url('/images/homebackground.jpg')}}" class="img-thumbnail" width="3000" height="2160" />
</div>
</div>

@endsection