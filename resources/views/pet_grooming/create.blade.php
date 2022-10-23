@extends('layouts.master')
@include('layouts.app')
@section('content')
<div class="container">
  <div id="viewport">
  <h2>Create new Grooming</h2>
  <form method="post" action="{{route('grooming.store')}}" enctype="multipart/form-data">

  @csrf
  <div class="jumbotron jumbotron-fluid">
  <div class="form-group">
    <label for="description" class="control-label">Description</label>
    <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
    @if($errors->has('description'))
    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
   @endif 
  </div> 
<div class="form-group"> 
    <label for="price" class="control-label">Price</label>
    <input type="text" class="form-control " id="price" name="price" value="{{old('price')}}"></text>
    @if($errors->has('price'))
    <div class="alert alert-danger">{{ $errors->first('price') }}</div>
   @endif 
  </div> 
  <div class="form-group">
    <label for="imagePath" class="control-label">Pet Grooming Image</label>
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