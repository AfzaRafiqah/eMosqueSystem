@component('mail::message')
# You have some reminders to follow up. Below are the details:

The body of your message.

@component('mail::table')
|Reminder|Event Name|
|:-------|:---------|
@foreach($reminders as $reminder)
|{{$reminder['reminder']}}|{{$reminder['eventName']}}|
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
