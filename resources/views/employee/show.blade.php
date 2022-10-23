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
        <a href="{{ route('employee.index') }}" class="btn btn-success">Back</a>
      </div>
      @foreach($employees as $employee)
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
                                        <p>{{$employee->fname}} {{$employee->lname}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Addressline</label>
                                        <p>{{$employee->addressline}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Town</label>
                                        <p>{{$employee->town}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Zipcode</label>
                                        <p>{{$employee->zipcode}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Employee I.D</label>
                                        <p>#{{$employee->id}}</p>
                                    </div>
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p>{{$employee->email}}</p>
                                    </div>
                                    <div class="media">
                                        <label>E-mail Verified</label>
                                        <p>{{$employee->email_verified_at}}</p>
                                    </div>
                                    <div class="media">
                                        <label>Account Created</label>
                                        <p>{{$employee->created_at}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset($employee->imagePath) }}" class="img-thumbnail" width="300" height="300" class="rounded" style="width:400px"/>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endforeach
@endsection