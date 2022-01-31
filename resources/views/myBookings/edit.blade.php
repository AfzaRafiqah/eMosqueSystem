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
            <div class="body">
                <form action="{{ route('myBookings.update',$event->id) }}" method="POST" onsubmit="return Compare()">
                    @csrf
                    @method('PUT')
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <label for="userId">User ID</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="userId" class="form-control" value="{{ $event->userId }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label for="eventName">Event's Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="eventName" name="eventName" class="form-control" value="{{ $event->eventName }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <label for="startDate">Start Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="txtFrom" class="form-control" name="startDate" min="<?= date('Y-m-d'); ?>"  value="{{ $event->startDate }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="endDate">End Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="txtTo" class="form-control" name="endDate" min="<?= date('Y-m-d'); ?>" value="{{ $event->endDate }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <label for="startTime">Start Time</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" id="txtStartTime" name="startTime" class="form-control" value="{{ $event->startTime }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="endTime">End Time</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" id="txtEndTime" name="endTime" class="form-control" value="{{ $event->endTime }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-5">
                            <label for="location">Location</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="location" name="location" class="form-control" value="{{ $event->location }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="part">Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="part" class="form-control" name="part" value="{{ $event->part }}" readonly />
                                </div>
                            </div>
                        </div>
                        @if($event->part == "Others")
                        <div class="col-sm-2">
                            <label for="numPart">Maximum Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="numPart" name = "numPart" class="form-control" value="{{ $event->numPart }}"  />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="minAge">Minimum Age</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="minAge" name="minAge" class="form-control" value="{{ $event->minAge }}"  />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn bg-brown" href="{{ route('myBookings.index') }}"> Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>
<!-- #END# Vertical Layout -->
@endsection