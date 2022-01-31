@extends('layouts.tempAdmin')
@section('content')
<!--nak tulis apa apa yg ada kat sini-->
<!-- Hover Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List Of User
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
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($users as $u)
                    <tbody>
                        <tr>
                            <th>{{ $u->id }}</th>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->phoneNumber }}</td>
                            <td class="project-actions text-left">
                                <a class="btn btn-info" href="{{ route('users.show',$u->id) }}">Show</a>
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