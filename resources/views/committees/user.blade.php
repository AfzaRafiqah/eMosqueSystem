@extends('layouts.tempUser')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div>
            <h2>List Of Committees</h2>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <!-- Bordered Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Committee Details
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-cyan">
                                    <th>Member id</th>
                                    <th>Name</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            @foreach ($committees as $c)
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $c->id }}</th>
                                    <td>{{ $c->users->name }}</td>
                                    <td>{{ $c->users->phoneNumber }}</td>
                                    <td>{{ $c->users->email }}</td>
                                    <td>{{ $c->role }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
</div>
@endsection