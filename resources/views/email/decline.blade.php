@extends('layouts.tempCom')
@section ('content')
<form method="post" action="{{url('sendemailD/send')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="hidden" id="eventName" name="eventName" value="{{$event->eventName}}"><br><br>
        <input type="hidden" id="userId" name="eventId" value="{{$user->id}}"><br><br>
        <input type="hidden" id="eventId" name="eventId" value="{{$event->id}}"><br><br>
        <input type="hidden" id="email" name="email" value="{{$user->email}}"><br><br>
        <input type="hidden" id="name" name="name" value="{{$user->name}}"><br><br>
        <input type="hidden" id="change" name="change" value="no"><br><br>
        <input type="submit" name="send" class="btn btn-info" value="Send" />
    </div>
</form>

@endsection