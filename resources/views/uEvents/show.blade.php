@extends('layouts.tempUser')
@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    BOOKING ID : {{ $event->id }}
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
            <div class="body cuba">
                <form>
                    <div class="row clearfix">
                        <div class="col-sm-5">
                            <label for="userId">Organizer</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" value="{{ $user->name }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-5">
                            <label for="eventName">Event's Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="eventName" class="form-control" value="{{ $event->eventName }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="status">Status</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="status" class="form-control" value="{{ $event->status }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <label for="startDate">Start Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="startDate" class="form-control" value="{{ $event->startDate }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="endDate">End Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="endDate" class="form-control" value="{{ $event->endDate }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <label for="startTime">Start Time</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="startTime" class="form-control" value="{{ $event->startTime }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="endTime">End Time</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="endTime" class="form-control" value="{{ $event->endTime }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-5">
                            <label for="location">Location</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="location" class="form-control" value="{{ $event->location }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="part">Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="part" class="form-control" value="{{ $event->part }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="numPart">Maximum Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="numPart" class="form-control" value="{{ $event->numPart }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="minAge">Minimum Age</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="minAge" class="form-control" value="{{ $event->minAge }}" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Vertical Layout -->
@endsection