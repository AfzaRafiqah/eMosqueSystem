@extends('layouts.tempAdmin')
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header ">
                <a type="button" class="btn btn-block btn-lg bg-brown waves-effect" href="{{ route('participates.create') }}">ADD PARTICIPATION</a>
            </div>
            <div class="header bg-grey">
                <h2>
                    LIST OF PARTICIPANTS<br>
                    EVENT'S ID :{{ $event->id}}<br>
                    EVENT'S NAME :{{ $event->eventName}}<br>
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
            <div class="body table-responsive cuba">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-deep-orange">
                            <th>ID</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($participates as $p)
                    <tbody>
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->users->phoneNumber }}</td>
                            <td>
                                <form action="{{ route('participates.destroy',$p->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
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