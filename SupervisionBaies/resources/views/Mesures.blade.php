@extends('Layouts.Layout')

@section('content')

<div class="container-fluid">
    <hr style="color: #222222">
    <h1 class="mt-4">Mesures / Bâtiment ??? </h1>
    <hr style="color: #222222">
</div>

@if(count($Mesures) > 0)
@foreach($Mesures as $Mesure)
<ul class="list-group">
    <li class="list-group-item">
        temperature: {{$Mesure->temperature}}
    </li>
    <li class="list-group-item">
        humidite: {{$Mesure->humidite}}
    </li>
    <li class="list-group-item">
        datetime: {{$Mesure->datetime}}
    </li>
</ul>
@endforeach
@endif

@endsection

@include('INC.Footer')