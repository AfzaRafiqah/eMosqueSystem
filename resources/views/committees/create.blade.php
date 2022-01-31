@extends('layouts.tempAdmin')

@section('content')
<div class="block-header">
    <h2>CREATE NEW COMMITTEE MEMBER</h2>
</div>

<!-- Advanced Select -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h2>
                    FORM
                </h2>
            </div>
            <div class="body">
                <form method="POST" action="{{ route('committees.store') }}">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <p>
                                <b>Choose User</b>
                            </p>
                            <select class="form-control show-tick" id="userId" type="text" name="userId" required>
                                <option value="" disabled="disabled" selected="selected">User</option>
                                @foreach ($users as $id => $name)
                                <option value="{{$id}}" {{ (isset($committees['userId']) && $committees['userId'] == $id) ? ' selected' : '' }}>{{$id}} : {{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <p>
                                <b>Choose Role</b>
                            </p>
                            <select class="form-control show-tick" id="role" type="text" name="role" required>
                                <option disabled="disabled" selected="selected">Role</option>
                                <option value="Imam">Imam</option>
                                <option value="Pengerusi">Pengerusi</option>
                                <option value="Setiausaha">Setiausaha</option>
                                <option value="Bendahari">Bendahari</option>
                                <option value="Bilal">Bilal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- #END# Advanced Select -->

@endsection