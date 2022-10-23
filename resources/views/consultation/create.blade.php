@extends('layouts.master')
@include('layouts.app')
@section('content')
<div class="container">
  <div id="viewport">
  <h2>Consultation</h2>
  <form method="post" action="{{route('consultation.store')}}" enctype="multipart/form-data">

  @csrf
  <div class="jumbotron jumbotron-fluid">
  <div class="form-group">
    <label for="description">Description</label>
    <select class="form-control" id="description" name="description" value="{{old('pet')}}">
      <option value="Ear infection">Ear infection</option>
      <option value="Skin infection">Skin infection</option>
      <option value="Upset stomach">Upset stomach</option>
      <option value="Diarrhea">Diarrhea</option>
      <option value="Bruise">Bruise</option>
      <option value="Allergies">Allergies</option>
      <option value="Bruise">Other...</option>
    </select>
    @if($errors->has('description'))
    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
   @endif 
  </div>

  <div class="form-group">
    <label for="pet_id">Pet I.D and Name</label>
    <select class="form-control" id="pet_id" name="pet_id" value="{{old('pet')}}">
      @foreach($pets as $id => $pet)
        <option value="{{$id}}"><a> {{$pet}} </a></option>
      @endforeach
    </select>
    @if($errors->has('pet'))
    <div class="alert alert-danger">{{ $errors->first('pet') }}</div>
   @endif 
  </div>
  <div class="form-group"> 
    <label for="message" class="control-label">Message</label>
    <textarea class="form-control" id="message" name="message" rows="3" value="{{old('message')}}" placeholder=""></textarea>
    @if($errors->has('message'))
<div class="alert alert-danger">{{  $errors->first('message') }}</div>
   @endif 
  </div>
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>
  </div>     
</div>
</div>
</form>
@endsection