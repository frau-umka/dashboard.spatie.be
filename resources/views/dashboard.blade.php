@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'clientConnectionPath', 'environment'))
<div id="dashboard">
    <dashboard class="font-sans">
        <twitter :initial-tweets="{{ json_encode($initialTweets) }}" position="a1:a24"></twitter>
        <tile-timer on="16:00" off="19:00">
            <trains position="a1:a24"></trains>
        </tile-timer>
        <team-member name="pepe" avatar="{{ gravatar('pgarciag93@gmail.com') }}" birthday="1993-09-10" position="b1:b8"></team-member>
        <internet-connection position="e1:e6"></internet-connection>
        <statistics position="b9:b24"></statistics>
        <time-weather position="c1:c8" date-format="dddd DD/MM/YYYY" time-zone="Europe/Madrid"></time-weather>
        <uptime position="d1:d10"></uptime>
        <calendar position="e1:e24"></calendar>
    </dashboard>
</div>

@endsection
