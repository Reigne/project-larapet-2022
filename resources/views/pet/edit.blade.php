@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
<div class="container">
  <h2>Edit pet</h2>
  {{ Form::model($pet,['route' => ['pet.update',$pet->id],'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}
     <div class="jumbotron jumbotron-fluid">
   <div class="form-group">
    <label for="customer_id">Owner I.D</label>
    {!! Form::select('customer_id', $customers, null, ['class' => 'form-control']) !!}
    @if($errors->has('customer_id'))
    <small>{{ $errors->first('customer_id') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="species" class="control-label">Species</label>
    {{ Form::text('species',null,array('class'=>'form-control','id'=>'species')) }}
    @if($errors->has('species'))
    <small>{{ $errors->first('species') }}</small>
   @endif 
  </div> 

  <div class="form-group"> 
    <label for="breed" class="control-label">Breed</label>
    {{ Form::text('breed',null,array('class'=>'form-control','id'=>'breed')) }}
    @if($errors->has('breed'))
    <small>{{ $errors->first('breed') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="name" class="control-label">Pet Name</label>
    {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}
    @if($errors->has('name'))
    <small>{{ $errors->first('name') }}</small>
   @endif 
    </div>

  <div class="form-group"> 
    <label for="gender" class="control-label">Gender</label>
    {{ Form::text('gender',null,array('class'=>'form-control','id'=>'gender')) }}
    @if($errors->has('gender'))
    <small>{{ $errors->first('gender') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="age" class="control-label">Age</label>
    {{ Form::text('age',null,array('class'=>'form-control','id'=>'age')) }}
    @if($errors->has('age'))
    <small>{{ $errors->first('age') }}</small>
   @endif 
  </div>

  <div class="form-group"> 
    <label for="color" class="control-label">Color</label>
    {{ Form::text('color',null,array('class'=>'form-control','id'=>'color')) }}
    @if($errors->has('color'))
    <small>{{ $errors->first('color') }}</small>
   @endif 
  </div>

  <div class="form-group">
    <label for="imagePath" class="control-label">pet Image</label>
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
</div>

{!! Form::close() !!} 
@endsection