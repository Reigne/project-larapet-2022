@extends('layouts.master')
@include('layouts.app')
@section('content')
<div class="container">
  <div id="viewport">
  <h2>Create new Employee</h2>
  <form method="post" action="{{route('employee.store')}}" enctype="multipart/form-data">

  @csrf
  <div class="jumbotron jumbotron-fluid">
  <div class="form-group">
    <label for="fname" class="control-label">First name</label>
    <input type="text" class="form-control" id="fname" name="fname" value="{{old('fname')}}">
    @if($errors->has('fname'))
    <div class="alert alert-danger">{{ $errors->first('fname') }}</div>
   @endif 
  </div> 
   <div class="form-group">
    <label for="lname" class="control-label">Last name</label>
    <input type="text" class="form-control" id="lname" name="lname" value="{{old('lname')}}">
    @if($errors->has('lname'))
    <div class="alert alert-danger">{{ $errors->first('lname') }}</div>
   @endif 
  </div> 
  <div class="form-group">
    <label for="addressline" class="control-label">Addressline</label>
    <input type="text" class="form-control" id="addressline" name="addressline" value="{{old('addressline')}}">
    @if($errors->has('addressline'))
    <div class="alert alert-danger">{{ $errors->first('addressline') }}</div>
   @endif 
  </div> 
  <div class="form-group">
    <label for="town" class="control-label">Town</label>
    <input type="text" class="form-control" id="town" name="town" value="{{old('town')}}">
    @if($errors->has('town'))
    <div class="alert alert-danger">{{ $errors->first('town') }}</div>
   @endif 
  </div>
  <div class="form-group">
    <label for="zipcode" class="control-label">Zipcode</label>
    <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{old('zipcode')}}">
    @if($errors->has('zipcode'))
    <div class="alert alert-danger">{{ $errors->first('zipcode') }}</div>
   @endif 
  </div>     
  <div class="form-group"> 
    <label for="email" class="control-label">Email</label>
    <input type="text" class="form-control " id="email" name="email" value="{{old('email')}}">
    @if($errors->has('fname'))
<div class="alert alert-danger">{{  $errors->first('email') }}</div>
   @endif 
  </div>
<div class="form-group"> 
    <label for="password" class="control-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
    @if($errors->has('password'))
    <div class="alert alert-danger">{{  $errors->first('password') }}</div>
   @endif 
  </div>
  <div class="form-group">
    <label for="imagePath" class="control-label">Employee Image</label>
    <input type="file" class="form-control" id="imagePath" name="image" >
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>
  </div>     
</div>
</div>
</form>
@endsection