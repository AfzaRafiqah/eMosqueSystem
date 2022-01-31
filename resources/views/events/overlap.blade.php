@extends('layouts.tempAdmin')
@section('content')
<!--nak tulis apa apa yg ada kat sini-->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-grey">
                <h2>
                    OVERLAP EVENT
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
                @if ($message = Session::get('warning'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </div>
            <div class="body table-responsive cuba">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-deep-orange">
                            <th>Event's Id</th>
                            <th>Event's Name</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($overlap as $o)
                    <tbody>
                        <tr>
                            <th><b>{{ $o->id }}</b></th>
                            <td><b>{{ $o->eventName }}</b></td>
                            <td><b>{{ $o->location }}</b></td>
                            <td><b>{{ $o->startDate }} - {{ $o->endDate }}</b></td>
                            <td><b>{{ $o->startTime }} - {{ $o->endTime }}</b></td>
                            <td class="project-actions text-left">
                                <a class="btn btn-info" href="{{ route('events.show',$o->id) }}">Show</a>
                            </td>
                            @csrf
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <a class="btn btn-success "  onclick="return confirm('Are you sure you want to Approve the event?')" href="{{ route('events.approveAnyway',$eventId) }}" >APPROVE ANYWAY</a>
            </div>
        </div>
    </div>
</div>
@endsection