<p>Assalamualaikum, and  hope you are in good health.</p>
<p>Just to remind you about the event {{ $events['eventName'] }} which will held soon.</p>
<p>The details as below</p>
<table>
    <tr>
        <th>Organizer</th>
        <td>{{ $events->users['name'] }}</td>
    </tr>
    <tr>
        <th>Date</th>
        <td>{{ $events['startDate'] }}</td>
    </tr>
    <tr>
        <th>Start Time</th>
        <td>{{ $events['startTime'] }}</td>
    </tr>
    <tr>
        <th>End Time</th>
        <td>{{ $events['endTime'] }}</td>
    </tr>
    <tr>
        <th>Location</th>
        <td>{{ $events['location'] }}</td>
    </tr>
</table>