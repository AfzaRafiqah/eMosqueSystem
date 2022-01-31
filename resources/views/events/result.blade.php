@extends('layouts.tempAdmin')
@section('content')
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-grey">
                <h2>
                    LIST OF EVENT <br>
                    FROM :{{ $start}}<br>
                    UNTIL :{{ $end  }}<br>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Organizer</th>
                                <th>Participation</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Organizer</th>
                                <th>Participation</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($events as $e)
                            <tr>
                                <td>{{ $e->id }}</td>
                                <td>{{ $e->eventName }}</td>
                                <td>{{ $e->startDate }} - {{ $e->endDate }}
                                <td>{{ $e->startTime }} - {{ $e->endTime }}
                                <td>{{ $e->users->name }}</td>
                                <td>{{ $e->part }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->

@endsection