


@extends('layouts.master')
@include('layouts.app')
@section('content')

<div id="viewport">
<div class="container">
  <h2>Service Review</h2>
   @if($message=Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @elseif($message=Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
    @endif
  <div class="jumbotron jumbotron-fluid">
  <div align="right">
    <a href="{{ route('shop.index')}}" class="btn btn-success">Back</a>
   </div>
     <p style="font-size:200%;" align="center">{{ $groomings->description }}</p>
    
    <div class="card" style="width:400px">
     <img src="{{ asset($groomings->imagePath) }}" class="img-thumbnail" width="300" height="300" class="rounded" style="width:400px"/>

  </div>
<hr>

<div class="container mt-10">
    <div class="row d-flex justify-content-center">
        <div class="col-md-13">
            <div class="shadow-sm p-4 bg-white rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-row align-items-center">
                        <span class="mr-1 fs-14">List of Comments</span>
                    </div>
                   {{--  <div class="d-flex flex-row align-items-center"><span class="mr-1 fs-14">Kyle Lawrence</span> <span class="carets"><i class="fa fa-caret-down"></i></span> </div> --}}
                </div>
                @foreach($reviews as $review)
                <div class="d-flex flex-row mt-4 "> <img src="{{ asset($review->cusImage) }}" class="rounded-circle" width="40" height="40">
                    <div class="ml-2 w-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center"> <span class="font-weight-bold name">{{ $review->fname }} {{ $review->lname }}</span> <span class="dots"></span> 
                                {{-- <small class="text-muted time-text">1h</small>  --}}
                            </div> 
                            <span class="top-comment">Date: {{ $review->created_at }} </span>
                        </div>
                        <p class="user-comment-text text-justify">{{ $review->comment}}</p>
                        <div class="mt-3 d-flex align-items-center"> 
                    </div>
                </div>
            </div>
            @endforeach
                {{$reviews->links()}}
                <hr>
                <h3>Add Comment Here</h3>
    <form method="post" action="{{route('grooming.reviewStore')}}">

      @csrf
       <div class="form-group">
        <input type="hidden" class="form-control" id="grooming_id" name="grooming_id" value="{{$groomings->id}}" readonly="true">
        @if($errors->has('grooming_id'))
        <small style="color: red">{{ $errors->first('grooming_id') }}</small>
       @endif 
      </div>
      <div class="form-group">
        <label for="email" class="control-label">Enter E-mail</label>
        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
        @if($errors->has('email'))
        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
        @endif 
      </div> 
      <div class="form-group"> 
        <label for="comment" class="control-label">Message</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" value="{{old('comment')}}" placeholder="Leave a comment here..."></textarea>
        @if($errors->has('comment'))
        <div class="alert alert-danger">{{  $errors->first('comment') }}</div>
        @endif 
      </div>

    <button type="submit" class="btn btn-primary">Comment</button>
    @endsection

        </div>
    </div>
</div>
</div>




{{-- <div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-6">
            <div class="bg-white comment-section">
                <div class="d-flex flex-row user p-2"><img class="rounded-circle" src="https://i.imgur.com/EQk6lCz.jpg" width="50">
                    <div class="d-flex flex-column ml-2"><span class="name font-weight-bold">Chris Hemsworth</span><span>10:30 PM, May 25</span></div>
                </div>
                <div class="mt-2 p-2">
                    <p class="comment-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="d-flex justify-content-between p-3 border-top"><span>Leave a comment</span>
                    <div class="d-flex align-items-center border-left px-3 comments"><i class="fa fa-comment"></i><span class="ml-2">6</span></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}