@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-grey">
                <h2>
                    LIST OF AVAILABLE EVENTS
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
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($events as $e)
                    <tbody>
                        <tr>
                            <th><b>{{ $e->id }}</b></th>
                            <td><b>{{ $e->eventName }}</b>
                            @if($e->active == 1)
                            <span class="label bg-blue">Active</span>
                            @else
                            <span class="label bg-grey">Inactive</span>
                            </td>
                            @endif
                            <td><b>{{ $e->startDate }}</b></td>
                            <td><b>{{ $e->startTime }}</b></td>
                            @if($e->status == 'Approve')
                            <td><span class="label bg-green">Approved</span></td>
                            @elseif($e->status == 'Pending')
                            <td><span class="label bg-orange">Pending</span></td>
                            @elseif($e->status == 'Cancel')
                            <td><span class="label bg-red">Canceled</span></td>
                            @elseif($e->status == 'Decline')
                            <td><span class="label bg-deep-orange">Decline</span></td>
                            @elseif($e->status == 'Completed')
                            <td><span class="label bg-pink">Completed</span></td>
                            @endif
                            <td class="project-actions text-left">
                                <a class="btn btn-info" href="{{ route('events.show',$e->id) }}">Show</a>
                                @if($e->status == 'Pending')
                                <a class="btn bg-pink waves-effect" onclick="return confirm('Are you sure you want to Approve the event?')" href="{{ route('email.approve',$e->id) }}">Approve</a>
                                <a class="btn bg-red waves-effect" href="{{ route('email.decline',$e->id) }}">Decline</a>
                                @endif
                            </td>
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
@endsection