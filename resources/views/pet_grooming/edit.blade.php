@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
<div class="container">
  <h2>Edit grooming</h2>
  {{ Form::model($grooming,['route' => ['grooming.update',$grooming->id],'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}

  <div class="jumbotron jumbotron-fluid">
  <div class="form-group"> 
    <label for="description" class="control-label">Description</label>
    {{ Form::text('description',null,array('class'=>'form-control','id'=>'description')) }}
    @if($errors->has('description'))
    <small>{{ $errors->first('description') }}</small>
   @endif 
  </div> 

  <div class="form-group"> 
    <label for="price" class="control-label">Price</label>
    {{ Form::text('price',null,array('class'=>'form-control','id'=>'price')) }}
    @if($errors->has('price'))
    <small>{{ $errors->first('price') }}</small>
   @endif 
  </div>


  <div class="form-group">
    <label for="imagePath" class="control-label">Grooming Image</label>
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