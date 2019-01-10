@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'clientConnectionPath', 'environment'))
<div id="dashboard">
    <dashboard class="font-sans">
        <internet-connection position="a1:a6"></internet-connection>
        <time-weather position="a1:a8" date-format="dddd DD/MM/YYYY" time-zone="Europe/Madrid"></time-weather>
        <calendar position="b1:b24"></calendar>
        <spotify position="a9:a14" authorize-url="{{ $authorizeUrl }}"></spotify>
    </dashboard>
</div>

@endsection
