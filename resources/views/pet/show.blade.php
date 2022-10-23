@extends('layouts.master')
@include('layouts.app')
@section('content')
    {{-- <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>user profile</h1>
            <p>{{ Auth::User()->name}}</p>
        </div>
     </div> --}}
     <hr>
     <div id="viewport">
      <div class="jumbotron jumbotron-fluid">
        <div align="right">
        <a href="{{ route('pet.index') }}" class="btn btn-success">Back</a>
      </div>
           @foreach($pets as $pet)
     <section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color">pet Profile</h3>
                            <h6 class="theme-color lead">Acme Clinic pet</h6>
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Name</label>
                                        <p>{{$pet->name}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Owner I.D and Name</label>
                                        <p>{{$pet->customer_id}} - {{$pet->fname}} {{$pet->lname}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Spescies</label>
                                        <p>{{$pet->species}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Breed</label>
                                        <p>{{$pet->breed}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>pet I.D</label>
                                        <p>#{{$pet->id}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Gender</label>
                                        <p>{{$pet->gender}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Color</label>
                                        <p>{{$pet->color}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Age</label>
                                        <p>{{$pet->age}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="{{ asset($pet->petImage) }}" class="img-thumbnail" width="300" height="300" class="rounded" style="width:400px"/ >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endforeach
@endsection