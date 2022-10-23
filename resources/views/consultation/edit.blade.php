@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
<div class="container">
  <h2>Comment for Consultation</h2>
  {{ Form::model($consultations,['route' => ['consultation.update',$consultations->id],'method'=>'PUT', 'enctype' =>'multipart/form-data']) }}

  <div class="jumbotron jumbotron-fluid">
  <div class="form-group" > 
      <label for="employee_id" class="control-label" >Vet ID:</label>
      <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Vet I.D / User I.D" value="{{ Auth::user()->id}}" readonly="">
      </text>@if($errors->has('employee_id')) 
      <small>{{ $errors->first('employee_id') }}</small>
     @endif 
  </div> 
  
  <div class="form-group"> 
    <label for="comment" class="control-label">Comment</label>
    {{ Form::textarea('comment',null,array('class'=>'form-control','id'=>'comment', 'placeholder'=>'Leave a comment here')) }}
    @if($errors->has('comment'))
    <small>{{ $errors->first('comment') }}</small>
   @endif 
  </div> 
  <div class="form-group"> 
    <label for="price" class="control-label">Price</label>
    {{ Form::text('price',null,array('class'=>'form-control','id'=>'price')) }}
    @if($errors->has('price'))
    <small>{{ $errors->first('price') }}</small>
   @endif 
  </div> 
  <button type="submit" class="btn btn-primary">Send</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>
</div>
  </div>     
{!! Form::close() !!} 
@endsection