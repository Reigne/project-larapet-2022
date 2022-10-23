@extends('layouts.master')
@include('layouts.app')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
   {{--  @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($groomings as $grooming)
                            <li class="list-group-grooming">
                                <span class="badge">{{ $grooming['qty'] }}</span>
                                <strong>{{ $grooming['grooming']['description'] }}</strong>
                                <span class="label label-success">{{ $grooming['price'] }}</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                   <ul class="dropdown-menu">
                                        <li><a href="{{ route('grooming.reduceByOne',['id'=>$grooming['grooming']['id']]) }}">Reduce By 1</a></li>
                                        <li><a href="{{ route('grooming.remove',['id'=>$grooming['grooming']['id']]) }}">Reduce All</a></li>
                                    </ul>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No pet services in Cart!</h2>
            </div>
        </div>
    @endif --}} 
{{-- <section class="vh-100" style="background-color: #fdccbc;"> --}}
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        @if(Session::has('cart'))
        <p><span class="h2">Shopping Cart </span><span class="h4">{{-- (1 item in your cart) --}}</span></p>
        <form method="post" action="{{ route('checkout') }}">
                @csrf
        @foreach($groomings as $grooming)
        <div class="card mb-4">
          <div class="card-body p-4">

            <div class="row align-items-center">
              {{-- <div class="col-md-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/1.webp"
                  class="img-fluid" alt="Generic placeholder image">
              </div> --}}
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Name</p>
                  <p class="lead fw-normal mb-0">{{ $grooming['grooming']['description'] }}</p>
                </div>
              </div>
         {{--      <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Color</p>
                  <p class="lead fw-normal mb-0"><i class="fas fa-circle me-2" style="color: #fdd8d2;"></i>
                    pink rose</p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Quantity</p>
                  <p class="lead fw-normal mb-0">1</p>
                </div>
              </div> --}}
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Price</p>
                  <p class="lead fw-normal mb-0">${{ $grooming['price'] }}</p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                    <p class="small text-muted mb-4 pb-2">Action</p>
                    <a href="{{ route('grooming.remove',['id'=>$grooming['grooming']['id']]) }}" class="btn btn-danger btn-sm me-2"> Remove </a>
                </div>
              </div>
            </div>

          </div>
        </div>
        @endforeach
        <div class="card mb-5">
          <div class="card-body p-4">

            <div class="float-end">
              <p class="mb-0 me-5 d-flex align-items-center">
                <span class="small text-muted me-2">Order total: 
                <span class="lead fw-normal">${{ $totalPrice }}</span> </span>
              </p>
            </div>

          </div>
        </div>

        <div class="card mb-5">
          <div class="card-body p-4">
                <form method="post" action="{{route('checkout')}}" enctype="multipart/form-data" >
                <div class="form-group"> 
                    <label for="email" class="control-label">Email</label>
                    {{ Form::text('email',null,array('class'=>'form-control','id'=>'email')) }}
                    @if($errors->has('email'))
                    <small>{{ $errors->first('email') }}</small>
                   @endif 
                  </div>
            {{-- </form> --}}
            </div> 
            </div>  
        </div>
        <div class="d-flex justify-content-end">
          <a class="btn btn-light btn-lg me-2">Continue shopping</a>
          {{-- <a class="btn btn-primary btn-lg" href="{{ route('checkout') }}">Checkout</a> --}}
          <button type="submit" class="btn btn-primary" href="{{ route('checkout') }}">Checkout</button>
        </div>

        @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No pet services in Cart!</h2>
            </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</form>
</section>
@endsection
