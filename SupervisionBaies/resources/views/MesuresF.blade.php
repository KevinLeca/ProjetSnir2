@extends('Layouts.Layout')

@section('content')
<div class="container-fluid">
    <hr style="color: #222222">
    <h1 class="mt-4">Mesures / Bâtiment F</h1>
    <hr style="color: #222222">
</div>

<!-- ------------------------- Formulaire de recherche ------------------------ -->
<div class="container-fluid bg-1">
    {!! Form::open(['url' => 'Alertes/submit']) !!} <!-- ouverture du formulaire laravel -->
    <table class="table table-bordered">
        <tr>
            <!-- inputs de type date pour la selection de la plage horaire -->
            <td>                
                <label for="startdate">Date début:</label>
                <input type="date" id="date-start" name="date-start" value="0000-00-00">
            </td>
            <td>
                <label for="stopdate">Date fin:</label>
                <input type="date" id="date-stop" name="date-stop" value="0000-00-00">
            </td>
            <!-- --------------------------------------------------------- -->
            <td rowspan="2" style="padding-top: 2%">
                <!-- Checkbox pour les alertes acquittées -->
                {!! Form::checkbox('checkbox') !!}
                {!! Form::label('checkbox', 'Alertes acquittées') !!} 
                <!-- ------------------------------------ --> 


                <!-- Bouton submit -->
                {!! Form::submit('VALIDER') !!}
                <!-- ------------- -->
            </td>
        </tr>
        <tr>
            <!-- inputs de type time pour affiner la plage horaire -->
            <td>
                <label for="starttime">Heure début:</label>
                <input type="time" id="time-start" name="time-start"></td>
            <td>
                <label for="stoptime">Heure fin:</label>
                <input type="time" id="time-stop" name="time-stop">
            </td>
            <!-- ------------------------------------------------- -->
        </tr>

    </table>
    {!! Form::close() !!} <!-- fermeture du formulaire laravel -->
</div>
<!-- -------------------------------------------------------------------------- -->

<br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>        
{!! $chart->script() !!}
{!! $chart->container() !!}

@endsection

@include('INC.Footer')