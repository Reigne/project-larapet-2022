@extends('layouts.master')
@include('layouts.app')
@section('content')
<div id="viewport">
<div class="container">
  <h2>Consultation Show</h2>
  <div class="jumbotron jumbotron-fluid" style="color: white; background:#1D5C63;">
      @foreach($consultations as $consultation)
  <div align="right">
    <a href="{{ route('consultation.index') }}" class="btn btn-success">Back</a>
   </div>
     <p style="font-size:200%;" align="center"></p>

    
    <h4 class=4E944F"card-title" style="font-size:130%;"><strong>Consultation I.D: </strong><small style="font-size:105%; color: white;"></small>{{$consultation->id}}</h4>

    <h4 class="card-title" style="font-size:130%;"><strong>Pet I.D: </strong><small style="font-size:105%; color: white;"></small>{{$consultation->pet_id}}</h4>

    <h4 class="card-title" style="font-size:130%;"><strong>Pet name: </strong><small style="font-size:105%; color: white;">{{$consultation->name}}</small></h4>

    <h4 class="card-title" style="font-size:130%;"><strong>Description: </strong><small style="font-size:105%; color: white;">{{$consultation->description}}</small></h4>
    
    <h4 class="card-title" style="font-size:130%;"><strong>Message: </strong><small style="font-size:105%; color: white;">{{$consultation->message}}</small></h4>

    <h4 class="card-title" style="font-size:130%;"><strong>Comment: </strong><small style="font-size:105%; color: white;">{{$consultation->comment}}</small></h4>

    <h4 class="card-title" style="font-size:130%;"><strong>Vet I.D: </strong><small style="font-size:105%; color: white;">{{$consultation->employee_id}}</small></h4>

    <h4 class="card-title" style="font-size:130%;"><strong>Price: </strong><small style="font-size:105%; color: white;">{{$consultation->price}}</small></h4>
    @endforeach
    </div>
  </div>
  </div>
</div>
</div>
</div>


@endsection


