<!-- Bordered Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LIST OF EVENT
                    <a class="btn bg-pink waves-effect" href="{{ route('participates.myPartIndex') }}" style="float: right;">My Participation</a>
                </h2>
                
            </div>
            <div class="body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Event's ID</th>
                            <th>NAME</th>
                            <th>CREATED BY</th>
                            <th>START DATE</th>
                            <th>START TIME</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $e)
                        <tr>
                            <th scope="row">{{ $e->id }}</th>
                            <td>{{ $e->eventName }}</td>
                            <td>{{ $e->users->name }}</td>
                            <td>{{ $e->startDate }}</td>
                            <td>{{ $e->startTime }}</td>
                            <td>
                                <a class="btn btn-info waves-effect" style="margin:5px;" href="{{ route('events.show',$e->id) }}">Show</a>
                                <a class="btn bg-green waves-effect" style="margin:5px;" href="{{ route('participates.list',$e->id) }}">View Participant</a>
                                <a class="btn bg-orange waves-effect" style="margin:5px;" href="{{ route('participates.manage',$e->id) }}">Manage</a>
                                @csrf
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# Bordered Table -->