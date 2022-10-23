@extends('layouts.master')
@include('layouts.app')
@section('content')
 <div class="container">
<div id="viewport">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Employee CRUD</h2>
            </div>
            <div class="pull-right">
                <a href=" {{route('employee.create')}} " class="btn btn-success">Create New Employee</a>
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
                <th>Employee I.D</th>
                <th>User I.D</th>
                <th>Full Name</th>
                {{-- <th>Email</th> --}}
                <th>Image</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->user_id}}</td>
                    <td>{{$employee->fname}} {{$employee->lname}}</td>
                    {{-- <td>{{$employee->fname}}</td> --}}
                    {{-- <td>{{$employee->email}}</td> --}}
                    {{-- <td>{{$employee->password}}</td> --}}
                    <td><img src="{{ asset($employee->imagePath) }}" width="80" 
                     height="80" class="rounded" ></td>
                    <td>
                        @if($employee-> deleted_at)
                            <span class="label label-default">Unavailable</span>
                        @else
                            <span class="label label-success">Available</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ action('EmployeeController@destroy', $employee->id) }}" method="post" role="form">
                            @if($employee->deleted_at)
                            <a class="btn btn-secondary" disabled>Show</a>
                            <a class="btn btn-secondary" disabled>Edit</a>
                            <a href="{{ route('employee.restore',$employee->id) }}" class="btn btn-success">Restore</a>
                            @else
                            <a href="{{ route('employee.show',$employee->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-primary">Edit</a>
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
        {{$employees->links()}}
    </div>
</div>
    </div>

</div>
@endsection
