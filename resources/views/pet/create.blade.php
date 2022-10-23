@extends('layouts.master')
@include('layouts.app')
@section('content')
<div class="container">
  <h2>Pet new Customer</h2>
  <form method="post" action="{{route('pet.store')}}" enctype="multipart/form-data">
  @csrf
   <div class="jumbotron jumbotron-fluid">
   <div class="form-group">
    <label for="customer_id">Owner I.D</label>
    <select class="form-control" id="customer_id" name="customer_id">
      @foreach($customers as $id => $customer)
        <option value="{{$id}}"><a> {{$customer}} </a></option>
      @endforeach
    </select>
  </div>
    <div class="form-group">
    <label for="species" class="control-label">Species</label>
    <input type="text" class="form-control" id="species" name="species" value="{{old('species')}}">
    @if($errors->has('species'))
    <small style="color: red">{{ $errors->first('species') }}</small>
   @endif 
  </div>
  <div class="form-group">
    <label for="breed" class="control-label">Breed</label>
    <input type="text" class="form-control" id="breed" name="breed" value="{{old('breed')}}">
    @if($errors->has('breed'))
    <small style="color: red">{{ $errors->first('breed') }}</small>
   @endif 
  </div>
    <div class="form-group">
    <label for="name" class="control-label">Pet Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
    @if($errors->has('name'))
    <small style="color: red">{{ $errors->first('name') }}</small>
   @endif 
 </div>
    <div class="form-group">
    <label for="gender">Gender</label>
    <select class="form-control" id="gender" name="gender">
      <option>Male</option>
      <option>Female</option>
    </select>
  </div>
    <div class="form-group">
    <label for="color" class="control-label">Color</label>
    <input type="text" class="form-control" id="color" name="color" value="{{old('color')}}">
    @if($errors->has('color'))
    <small style="color: red">{{ $errors->first('color') }}</small>
   @endif 
  </div>
    <div class="form-group">
    <label for="age" class="control-label">Age</label>
    <input type="text" class="form-control" id="age" name="age" value="{{old('age')}}">
    @if($errors->has('age'))
    <small style="color: red">{{ $errors->first('age') }}</small>
   @endif 
  </div>
   <div class="form-group">
    <label for="imagePath" class="control-label">Pet Image</label>
    <input type="file" class="form-control" id="imagePath" name="image">
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>
  </div>     
</div>
</form>
@endsection