@extends('Layouts.Layout')

@section('content')
<div class="container-fluid">
    <hr style="color: #222222">
    <h1 class="mt-4">Mesures / Bâtiment C</h1>
    <hr style="color: #222222">
</div>

<br><br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>        
{!! $chart->script() !!}
{!! $chart->container() !!}

@endsection

@include('INC.Footer')