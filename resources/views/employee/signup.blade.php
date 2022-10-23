@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
              <div class="jumbotron jumbotron-fluid">
            <form class="" action="{{ route('employee.signup') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                 <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="addressline">Addressline: </label>
                    <input type="text" name="addressline" id="addressline" class="form-control">
                </div>
                <div class="form-group">
                    <label for="town">Town: </label>
                    <input type="text" name="town" id="town" class="form-control">
                </div>
                <div class="form-group">
                    <label for="zipcode">Zipcode: </label>
                    <input type="text" name="zipcode" id="zipcode" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="imagePath" class="control-label">Employee Image</label>
                    <input type="file" class="form-control" id="imagePath" name="image" >
                </div>
                    <input type="submit" value="Sign Up" class="btn btn-primary">
                    <a href="{{ route('employee.signin') }}"><small>Login</small></a>
             </form>
         </div>
        </div>
    </div>
</div>
@endsection