@extends('layouts.master')
@include('layouts.app')
@section('content')
<div class="container">
<div id="viewport">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                @if (Auth::check())
                <h2>Consultation CRUD</h2>
                @else
                <h2>Consultation</h2>
                @endif
            </div>
            <div class="pull-right">
                <a href=" {{route('consultation.create')}} " class="btn btn-success">Consult Now</a>
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
            <thead class="table-primary">
                @if (Auth::check())
                    {{-- <form action="/search" method="get">
                    <div class="input-group mb-3" align="right">
                        <input type="text" name="search" placeholder="Search...">
                            <button type="submit" class="btn btn-success" type="button" id="search"><i class="fas fa-search"></i> Search</button>
                    </div>
                    </form> --}}
                    <form action="/searchCon" method="get">
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
                @else
                @endif
            <tr>
                <th>Consultation I.D</th>
                <th>Pet I.D</th>
                <th>Pet Name</th>
                <th>Description</th>
                <th>Vet I.D</th>
                @if (Auth::check())
                <th>Status</th>
                <th width="280px">Action</th>
                @else
                <th>Customer Message</th>
                <th>Vet Comment</th>
                <th>Price</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($consultations as $consultation)
                <tr>
                    <td><strong>{{$consultation->id}}</strong></td>
                    <td>{{$consultation->pet_id}}</td>
                    <td>{{$consultation->petname}}</td>
                    <td>{{$consultation->description}}</td>
                    <td>{{$consultation->employee_id}}</td>
                    @if (Auth::check())
                    @else
                    <td>{{$consultation->message}}</td>
                    <td>{{$consultation->comment}}</td>
                    <td>{{$consultation->price}}</td>
                    @endif
                    @if (Auth::check())
                    <td>
                        @if($consultation->comment)
                            <span class="label label-success">Responded</span>
                        @else
                            <span class="label label-default">No Response</span>
                        @endif
                    </td>
                    <td>
                     <form action="{{ action('ConsultationController@destroy', $consultation->id) }}" method="post" role="form">
                            
                                @if($consultation->deleted_at)
                                <a class="btn btn-secondary" disabled>Show</a>
                                <a class="btn btn-secondary" disabled>Comment</a>
                                <a href="{{ route('consultation.restore',$consultation->id) }}" class="btn btn-success">Restore</a>
                                @else
                                <a href="{{ route('consultation.show',$consultation->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('consultation.edit',$consultation->id) }}" class="btn btn-primary">Comment</a>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @endif
                        </form>
                    </td>
                    @else
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$consultations->links()}}
    </div>
</div>
    </div>

</div>
@endsection
