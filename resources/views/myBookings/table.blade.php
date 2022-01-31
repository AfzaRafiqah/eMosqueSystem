@section('content')
<!-- Hover Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    MY EVENT
                </h2>
                <small>**Make sure the event is active for Admin to see**</small>
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
                            <th>Event's Name</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($events as $e)
                    <tbody>
                        <tr>
                            <th>{{ $e->id }}</th>
                            <td>{{ $e->eventName }}
                                @if($e->active == 1)
                                <span class="label bg-blue">Active</span>
                                @else
                                <span class="label bg-grey">Inactive</span>
                            </td>
                            @endif
                            <td>{{ $e->startDate }}</td>
                            <td>{{ $e->startTime }}</td>
                            @if($e->status == 'Approve')
                            <td><span class="label bg-green">Approved</span></td>
                            @elseif($e->status == 'Pending')
                            <td><span class="label bg-orange">Pending</span></td>
                            @elseif($e->status == 'Cancel')
                            <td><span class="label bg-red">Canceled</span></td>
                            @elseif($e->status == 'Reject')
                            <td><span class="label bg-deep-orange">Rejected</span></td>
                            @elseif($e->status == 'Completed')
                            <td><span class="label bg-pink">Completed</span></td>
                            @elseif($e->status == 'Decline')
                            <td><span class="label bg-deep-orange">Decline</span></td>
                            @elseif($e->status == 'Expired')
                            <td><span class="label bg-grey">Expired</span></td>
                            @endif
                            <td class="project-actions text-left">
                                <a class="btn btn-info" href="{{ route('myBookings.show',$e->id) }}">Show</a>
                                @if($e->status == 'Pending')
                                <a class="btn btn-primary" href="{{ route('myBookings.edit',$e->id) }}">Edit</a>
                                @endif
                                @if($e->status == 'Approve' || $e->status == 'Pending')
                                <a class="btn btn-danger" data-type="confirm" href="{{ route('myBookings.cancel',$e->id) }}">Cancel</a>
                                @endif
                                @csrf
                            </td>
                            @if($e->status == 'Pending')
                            <td>
                                @if($e->active ==1)<a type="button" href="{{ route('myBookings.active',$e->id) }}" class="btn bg-grey btn-block btn-xs waves-effect" data-toggle="tooltip" data-placement="top" title="CLICK TO DEACTIVATE THE EVENT">Deactivate</a>
                                @else<a type="button" href="{{ route('myBookings.active',$e->id) }}" class="btn bg-blue btn-block btn-xs waves-effect" data-toggle="tooltip" data-pla cement="top" title="CLICK TO ACTIVATE THE EVENT">Activate</a>
                                @endif
                            </td>
                            @endif
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