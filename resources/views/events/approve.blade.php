@extends('layouts.tempAdmin')
@section('content')
<!-- Bordered Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LIST OF APPROVED EVENT
                </h2>
            </div>
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
            <div class="body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>EVENT'S NAME</th>
                            <th>START DATE</th>
                            <th>START TIME</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $e)
                        <tr>
                            <th scope="row">{{ $e->id }}</th>
                            <td>{{ $e->eventName }}</td>
                            <td>{{ $e->startDate }}</td>
                            <td>{{ $e->startTime }}</td>
                            <td class="project-actions text-left">
                                <a class="btn btn-info" href="{{ route('events.show',$e->id) }}">Show</a>
                                @csrf
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn bg-brown" href="{{ route('events.pending') }}">Go To Pending Event</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Bordered Table -->
@endsection