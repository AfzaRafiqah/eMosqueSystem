@extends('layouts.tempUser')
@section('content')
<!-- Hover Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    EVENT AVAILABLE
                </h2>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                @if ($message = Session::get('danger'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </div>
            <div class="body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-cyan">
                            <th>ID</th>
                            <th>Registered Name</th>
                            <th>Event's Name</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($participates as $p)
                    <tbody>
                        <tr>
                            <th>{{ $p->id }}</th>
                            <td>{{ $p->name }}</th>
                            <td>{{ $p->events->eventName }}</td>
                            <td>{{ $p->events->startDate }}</td>
                            <td>{{ $p->events->startTime }}</td>
                            <td>
                                <form action="{{ route('participates.destroy',$p->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-success" style="margin:5px;" href="{{ route('myBookings.show',$p->events->id) }}">Details</a>
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# Hover Rows -->
@endsection