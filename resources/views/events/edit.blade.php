@extends('layouts.tempAdmin')
@section('content')
<!-- Vertical Layout -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    EVENT ID : {{ $event->id }}
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
                <form action="{{ route('events.update',$event->id) }}" method="POST" onsubmit="return Compare()">
                    @csrf
                    @method('PUT')
                    <div class="row clearfix">
                        <div class="col-sm-1">
                            <label for="userId">Event ID</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="id" class="form-control" name="id" value="{{ $event->id }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="eventType">Event's Type</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="eventType" name="eventType" class="form-control" value="{{ $event->eventType }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
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
                                    <input type="date" id="txtFrom" name="startDate" class="form-control" min="<?= date('Y-m-d'); ?>" value="{{ $event->startDate }}" />
                                </div>
                            </div>
                        </div>
                        @if($event->eventType == "Kem")
                        <div class="col-sm-3">
                            <label for="endDate">End Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" id="txtTo" name="endDate" class="form-control" min="<?= date('Y-m-d'); ?>" value="{{ $event->endDate }}" />
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-sm-3">
                            <label for="endDate">End Date</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="txtTo" name="endDate" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        @endif
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
                                    <input type="text" id="part" name="part" class="form-control" value="{{ $event->part }}" readonly />
                                </div>
                            </div>
                        </div>
                        @if($event->part == "Others")
                        <div class="col-sm-2">
                            <label for="numPart">Maximum Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="numPart" name="numPart" class="form-control" value="{{ $event->numPart }}" />
                                </div>
                            </div>
                        </div>
                        @else
                        <div hidden class="col-sm-2">
                            <label for="numPart">Maximum Participation</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="numPart" name="numPart" class="form-control" value="{{ $event->numPart }}" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row clearfix">
                        @if($event->part != "Committee Member")
                        <div class="col-sm-2">
                            <label for="minAge">Minimum Age</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="minAge" name="minAge" class="form-control" value="{{ $event->minAge }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="maxAge">Maximum Age</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="maxAge" name="maxAge" class="form-control" value="{{ $event->maxAge }}" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                            <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
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