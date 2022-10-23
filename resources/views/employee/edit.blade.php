@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
<div class="container">
  <h2>Edit Employee</h2>
  {{ Form::model($employee,['route' => ['employee.update',$employee->id],'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}

  <div class="jumbotron jumbotron-fluid">
    <div class="form-group"> 
    <label for="fname" class="control-label">First name</label>
    {{ Form::text('fname',null,array('class'=>'form-control','id'=>'fname')) }}
    @if($errors->has('fname'))
    <small>{{ $errors->first('fname') }}</small>
   @endif 
  </div> 

  <div class="form-group"> 
    <label for="name" class="control-label">Last name</label>
    {{ Form::text('lname',null,array('class'=>'form-control','id'=>'lname')) }}
    @if($errors->has('lname'))
    <small>{{ $errors->first('lname') }}</small>
   @endif 
  </div> 

  <div class="form-group"> 
    <label for="addressline" class="control-label">Addressline</label>
    {{ Form::text('addressline',null,array('class'=>'form-control','id'=>'addressline')) }}
    @if($errors->has('addressline'))
    <small>{{ $errors->first('addressline') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="town" class="control-label">Town</label>
    {{ Form::text('town',null,array('class'=>'form-control','id'=>'town')) }}
    @if($errors->has('town'))
    <small>{{ $errors->first('town') }}</small>
   @endif 
  </div>

   <div class="form-group"> 
    <label for="zipcode" class="control-label">Zipcode</label>
    {{ Form::text('zipcode',null,array('class'=>'form-control','id'=>'zipcode')) }}
    @if($errors->has('zipcode'))
    <small>{{ $errors->first('zipcode') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="email" class="control-label">Email</label>
    {{ Form::text('email',null,array('class'=>'form-control','id'=>'email')) }}
    @if($errors->has('fname'))
    <small>{{ $errors->first('fname') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="confirmpassword" class="control-label">Confirm Password</label>
    <input type="text " class="form-control" id="confirmpassword" name="confirmpassword" value="{{old('confirmpassword')}}">
    @if($errors->has('password'))
    <div class="alert alert-danger">{{  $errors->first('password') }}</div>
   @endif 
  </div>

<div class="form-group"> 
    <label for="password" class="control-label">New Password</label>
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
  <button type="submit" class="btn btn-primary">Update</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>
</div>
  </div>     
{!! Form::close() !!} 
@endsection