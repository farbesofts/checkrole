<h3>UNATHORIZED ACCESS</h3>
<p>
    @php
    $timetable = session()->get('timetable');
    $time_initiate = \Carbon\Carbon::parse($timetable->time_initiate)->format('h:i a');
    $time_end = \Carbon\Carbon::parse($timetable->time_end)->format('h:i a');
    @endphp
    <h5>Allowed Timetable: <strong>From {{ $time_initiate }} To {{ $time_initiate }}</strong></h5>
</p>
<p>
    <a href="/home" >Return To Home</a>
</p>