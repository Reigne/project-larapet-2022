@extends('layouts.master')
@include('layouts.app')
@section('content')
 <div class="container">
<div id="viewport">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h1>Transaction History</h1>
            </div>
            {{-- <div class="pull-right">
                <a href=" {{route('pet.create')}} " class="btn btn-success">Create New Pet</a>
            </div> --}}
        </div>
        
    </div>
    @if($message=Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    <div class="jumbotron jumbotron-fluid">
    <div class="table-responsive">
        <form action="/search" method="get">
                    <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search for Consultation I.D / Pet I.D / Pet name" name="search">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-success" type="submit" id="search">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
                </div>
                </form>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Customer First Name</th>
                <th>Customer Last Name</th>
                <th>Description</th>
                <th>Orderinfo I.D</th>
                <th>Orderline I.D</th>
                <th>Price</th>
                {{-- <th>First Name</th> --}}
            {{--     <th>Image</th>
                <th>Status</th>
                <th width="280px">Action</th> --}}
            </tr>
            </thead>
            <tbody>
            @foreach($orderinfos as $orderinfo)
                <tr>
                    <td>{{ $orderinfo->fname }}</td>
                    <td>{{ $orderinfo->lname }}</td>
                    <td>{{ $orderinfo->description }}</td>
                    <td>{{ $orderinfo->orderinfo_id }}</td>
                    <td>{{ $orderinfo->grooming_id }}</td>
                    <td>{{ $orderinfo->price }}</td>
                    {{-- <td><img src="{{ asset($pet->petImage) }}" width="80" 
                     height="80" class="rounded" ></td>
                    <td>@if ($pet->deleted_at)
                            <span class="label label-default">Unavailable</span>
                            @else
                            <span class="label label-success">Available</span>
                            @endif
                          </td>
                    <td>
                        <form action="{{ action('PetController@destroy', $pet->id) }}" method="post" role="form">
                            @if($pet->deleted_at)
                            <a class="btn btn-secondary" disabled>Show</a>
                            <a class="btn btn-secondary" disabled>Edit</a>
                            <a href="{{ route('pet.restore',$pet->id) }}" class="btn btn-success">Restore</a>
                            @else
                            <a href="{{ route('pet.show',$pet->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('pet.edit',$pet->id) }}" class="btn btn-primary">Edit</a>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endif
                        </form>
                    </td> --}}
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- {{ $orderinfos->links() }} --}}
    </div>
    </div>
</div>
    </div>
@endsection
