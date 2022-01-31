@extends('layouts.tempCom')
@section('content')
<!-- Striped Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    PENDING EVENTS
                </h2>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Event's Id</th>
                        <th>Event's Name</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($events as $e)
                    <tbody>
                        <tr>
                            <td scope="row">{{ $e->id }}</td>
                            <td>{{ $e->eventName }}</td>
                            <td>{{ $e->startDate }}</td>
                            <td>{{ $e->startTime }}</td>
                            <td>{{ $e->status }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info" href="{{ route('events.show',$e->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('events.edit',$e->id) }}">Update</a>
                                <a class="btn btn-primary" href="{{ route('email.approve',$e->id) }}">Approve</a>
                                <a class="btn btn-primary" href="{{ route('email.decline',$e->id) }}">Decline</a>
                                @csrf
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# Striped Rows -->
@endsection