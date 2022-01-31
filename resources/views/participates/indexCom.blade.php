@extends('layouts.tempCom')
@section('content')
<!-- Bordered Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LIST OF EVENT
                    <a class="btn bg-pink waves-effect" href="{{ route('participates.myPartIndex') }}" style="float: right;">My Participation</a>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created By</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($events as $e)
                            <tr >
                                <td class="bg-grey">{{ $e->id }}</td>
                                <td class="bg-blue-grey">{{ $e->eventName }}</td>
                                <td class="bg-grey">{{ $e->users->name }}</td>
                                <td class="bg-blue-grey">{{ $e->startDate }}</td>
                                <td class="bg-grey">{{ $e->startTime }}</td>
                                <td class="bg-blue-grey">
                                    <a class="btn btn-info waves-effect" style="margin:5px;" href="{{ route('myBookings.show',$e->id) }}">Show</a>
                                    <a class="btn bg-green waves-effect" style="margin:5px;" href="{{ route('participates.list',$e->id) }}">View Participant</a>
                                    @csrf
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# Bordered Table -->
@endsection