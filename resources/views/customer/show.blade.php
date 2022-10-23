

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
        <a href="{{ route('customer.index') }}" class="btn btn-success">Back</a>
      </div>
     <section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color">Customer Profile</h3>
                            <h6 class="theme-color lead">Acme Clinic Customer</h6>
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Name</label>
                                        <p>{{$customer->title}} {{$customer->fname}} {{$customer->lname}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Addressline</label>
                                        <p>{{$customer->addressline}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Town</label>
                                        <p>{{$customer->town}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Zipcode</label>
                                        <p>{{$customer->zipcode}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Customer I.D</label>
                                        <p>#{{$customer->id}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Phone Number</label>
                                        <p>{{$customer->phone}}</p>
                                    </div>
                                    <div class="media">
                                        <label>E-mail Verified</label>
                                        <p>{{$customer->email}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Account Created</label>
                                        <p>{{$customer->created_at}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="{{ asset($customer->imagePath) }}" class="img-thumbnail" width="300" height="300" class="rounded" style="width:400px"/ >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection