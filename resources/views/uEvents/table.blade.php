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
                            <th>Event's Name</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($events as $e)
                    <tbody>
                        <tr>
                            <th>{{ $e->id }}</th>
                            <td>{{ $e->eventName }}</td>
                            <td>{{ $e->startDate }}</td>
                            <td>{{ $e->startTime }}</td>
                            <td>
                                <a class="btn btn-success" style="margin:5px;" href="{{ route('uEvents.show',$e->id) }}">Details</a>
                                <a class="btn bg-deep-orange waves-effect" style="margin:5px;" href="{{ route('participates.myself',$e->id) }}">Join for yourself</a>
                                <a class="btn bg-orange waves-effect" style="margin:5px;" href="{{ route('participates.create',['event'=>$e->id]) }}">Join for others</a>
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
<!-- #END# Hover Rows -->
@endsection