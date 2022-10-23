@extends('layouts.master')
@include('layouts.app')
@section('content')
 <div class="container">
<div id="viewport">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Pet Grooming CRUD</h2>
            </div>
            <div class="pull-right">
                <a href=" {{route('grooming.create')}} " class="btn btn-success">Create New Grooming</a>
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
                <th>Pet Grooming I.D</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($groomings as $grooming)
                <tr>
                    <td>{{$grooming->id}}</td>
                    <td>{{$grooming->description}}</td>
                    <td><img src="{{ asset($grooming->imagePath) }}" width="80" 
                     height="80" class="rounded" ></td>
                    <td>
                        @if($grooming-> deleted_at)
                            <span class="label label-default">Unavailable</span>
                        @else
                            <span class="label label-success">Available</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ action('GroomingController@destroy', $grooming->id) }}" method="post" role="form">
                            @if($grooming->deleted_at)
                            <a class="btn btn-secondary" disabled>Show</a>
                            <a class="btn btn-secondary" disabled>Edit</a>
                            <a href="{{ route('grooming.restore',$grooming->id) }}" class="btn btn-success">Restore</a>
                            @else
                            <a href="{{ route('grooming.show',$grooming->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('grooming.edit',$grooming->id) }}" class="btn btn-primary">Edit</a>
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
        {{$groomings->links()}}
    </div>
</div>
    </div>

</div>
@endsection
