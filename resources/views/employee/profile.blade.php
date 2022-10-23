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
     <section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color">Profile</h3>
                            <h6 class="theme-color lead">Acme Clinic Employee</h6>
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Name</label>
                                        <p>{{ Auth::user()->name}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Addressline</label>
                                        <p>{{ Auth::user()->addressline}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Town</label>
                                        <p>{{ Auth::user()->town}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Zipcode</label>
                                        <p>{{ Auth::user()->zipcode}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Employee I.D</label>
                                        <p>#{{ Auth::user()->id}}</p>
                                    </div>
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p>{{ Auth::user()->email}}</p>
                                    </div>
                                    <div class="media">
                                        <label>E-mail Verified</label>
                                        <p>{{ Auth::user()->email_verified_at}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Account Created</label>
                                        <p>{{ Auth::user()->created_at}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                            <img src="{{ Auth::user()->imagePath}}" title="" alt="" class="shadow-lg p-3 mb-5 bg-white rounded"  width="500" height="400"  style="width:400px">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection