@extends('layouts.master')
@include('layouts.app')
@section('content')
 <div class="container">
<div id="viewport">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Customer CRUD</h2>
            </div>
            <div class="pull-right">
                <a href=" {{route('customer.create')}} " class="btn btn-success">Create New Customer</a>
            </div>
        </div>
    </div>
    @if($message=Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    <div class="jumbotron jumbotron-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Customer I.D</th>
                <th>Title</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Image</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td><strong>{{$customer->id}}</strong></td>
                    <td>{{$customer->title}}</td>
                    <td>{{$customer->lname}}</td>
                    <td>{{$customer->fname}}</td>
                    {{-- <td><img src="{{ asset('storage/'.$customer->imagePath) }}" width="80" 
     height="80"/></td> --}}
                    <td><img src="{{ asset($customer->imagePath) }}" width="80" height="80" class="rounded" ></td>
                    <td>
                        @if($customer->deleted_at)
                            <span class="label label-default">Unavailable</span>
                        @else
                            <span class="label label-success">Available</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ action('CustomerController@destroy', $customer->id) }}" method="post" role="form">
                            @if($customer->deleted_at)
                            <a class="btn btn-secondary" disabled>Show</a>
                            <a class="btn btn-secondary" disabled>Edit</a>
                            <a href="{{ route('customer.restore',$customer->id) }}" class="btn btn-success">Restore</a>
                            
                            @else
                            <a href="{{ route('customer.show',$customer->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-primary">Edit</a>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$customers->links()}}
    </div>
</div>
    </div>

</div>
@endsection
