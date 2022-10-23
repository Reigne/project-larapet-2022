


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
        <a href="{{ route('grooming.index') }}" class="btn btn-success">Back</a>
      </div>
     <section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color">grooming Profile</h3>
                            <h6 class="theme-color lead">Acme Clinic grooming</h6>
                            <div class="row about-list">
                                <div class="col-md-6">
                                  <div class="media">
                                        <label>Grooming I.D</label>
                                        <p>{{$grooming->id}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Description</label>
                                        <p>{{$grooming->description}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Price</label>
                                        <p>{{$grooming->price}}</p>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="{{ asset($grooming->imagePath) }}" class="img-thumbnail" width="300" height="300" class="rounded" style="width:400px"/ >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection