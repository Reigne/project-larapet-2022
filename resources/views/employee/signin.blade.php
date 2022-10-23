@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign In</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="jumbotron jumbotron-fluid">
            <form class="" action="{{ route('employee.signin') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="acmeclinic@email.com">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                    <input type="submit" value="Sign In" class="btn btn-primary">
                    <a href="{{ route('employee.signup') }}"><small>Register</small></a>
             </form>
         </div>
        </div>
    </div>
</div>

@endsection