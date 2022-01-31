@extends('layouts.tempUser')
@section('content')
<!-- Colored Card - With Loading -->

<div class="block-header">
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
    <h2>
        UPCOMING EVENTS
    </h2>
</div>
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<div class="row">

    @foreach ($events as $e)
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header bg-indigo">
                <h2>
                    {{ $e->eventName }} <small>{{ $e->startDate }}</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                @if($e -> part=="Others")
                    <li data-toggle="tooltip" data-placement="top" title="CLICK TO JOIN THE EVENT">
                        <a href="{{ route('participates.myself',$e->id) }}">
                            <i class="material-icons">person</i>
                        </a>
                    </li>
                    <li data-toggle="tooltip" data-placement="top" title="CLICK TO REGISTER  OTHERS TO JOIN THE EVENT">
                        <a href="{{ route('participates.create',['event'=>$e->id]) }}">
                            <i class="material-icons">person_add</i>
                        </a>
                    </li>
                    @endif
                    <li class="dropdown" data-toggle="tooltip" data-placement="top" title="CLICK HERE">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('uEvents.show',$e->id) }}">View Details</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <p class="font-bold col-blue-grey"><b>DATE : </b>{{ $e->startDate }}</p>
                <p class="font-bold col-blue-grey"><b>TIME : </b>{{ $e->startTime }}</p>
                <p class="font-bold col-blue-grey"><b>LOCATION : </b>{{ $e->location }}</p>
            </div>
        </div>
    </div>
    @csrf
    @endforeach
</div>
<!-- #END# Colored Card - With Loading -->
@endsection