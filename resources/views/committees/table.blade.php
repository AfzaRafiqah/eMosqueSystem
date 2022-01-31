@section('content')
<div class="row">
    <div class="col-md-12">
        <div>
            <h2>List Of Committees</h2>
        </div>
        <div>
            <a class="btn bg-cyan btn-lg waves-effect" href="{{ route('committees.create') }}">ADD NEW COMMITTEE</a>
        </div>
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
        <!-- Bordered Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            COMMITTEE MEMBERS
                        </h2>
                    </div>
                    <div class="body table-responsive cuba">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-cyan">
                                    <th>MEMBER ID</th>
                                    <th>NAME</th>
                                    <th>PHONE NUMBER</th>
                                    <th>ROLE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            @foreach ($committees as $c)
                            <tbody>
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->users->name }}</td>
                                    <td>{{ $c->users->phoneNumber }}</td>
                                    <td>{{ $c->role }}</td>
                                    <td class="project-actions text-right">
                                        <form action="{{ route('committees.destroy',$c->id) }}" method="POST">

                                            <a class="btn btn-info" href="{{ route('committees.showCom',$c->id) }}">Show</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
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
        <!-- #END# Bordered Table -->
    </div>
</div>
@endsection