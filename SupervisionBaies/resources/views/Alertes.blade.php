@extends('Layouts.Layout')

@section('content')
<div class="container-fluid">
    <hr style="color: #222222">
    <h1 class="mt-4">Alertes</h1>
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

<br><br>
<div class="container-fluid bg-1 text-center">
    <!-- ------------------------ Affichage des données --------------------------- -->
    <div class="container-fluid bg-2 text-center">
        <table class="table table-bordered" style="font-size: 20px; text-align: center; position: relative; margin-bottom: 70px">
            <thead>
                <tr>
                    <th style="text-align: center">Baie</th>
                    <th style="text-align: center">Type d'incident</th>
                    <th style="text-align: center">Date d'alerte</th>
                    <th style="text-align: center">Acquitter</th>
                </tr>
            </thead>
            <tbody>
                @if(count($Alertes) > 0) <!-- je verifie d'abords la présence d'alertes -->
                    @foreach($Alertes as $Alerte) <!-- J'affiche les informations relatives à chaque alertes -->
                        <tr>
                            <!-- Affichage du bâtiment selon l'id de la baie A MODIFIER INTELLIGEMMENT -->
                            @if($Alerte->id_baie == 1)
                                <td>Bâtiment B</td>
                            @endif
                            @if($Alerte->id_baie == 2)
                                <td>Bâtiment C</td>
                            @endif
                            @if($Alerte->id_baie == 3)
                                <td>Bâtiment D</td>
                            @endif
                            @if($Alerte->id_baie == 4)
                                <td>Bâtiment F</td>
                            @endif
                            @if($Alerte->id_baie == 5)
                                <td>Bâtiment G</td>
                            @endif
                            <!-- ------------------------------------------- -->
                            
                            <!-- Affichage de l'intitulé d'alerte selon le booléen (1=temperature, 0=humidité) -->
                            @if($Alerte->type_alerte == 1)
                                <td>Température élevée</td>
                            @endif
                            @if($Alerte->type_alerte == 0)
                                <td>Humidité élevée</td>
                            @endif
                            <td>{{$Alerte->datetime}}</td>
                            <!-- ----------------------------------------------------------------------------- -->
                            
                            <!-- Bouton pour acquitter (seulement si l'alerte ne l'est pas)-->
                            <td>
                                @if($Alerte->etat_alerte == 0)
                                {!! Form::open(['url' => 'Alertes/acquitter']) !!}
                                <!-- Creation de champ cachés pur pouvoir acquitter une alerte -->
                                    {{ Form::hidden('alerteID', $Alerte->id_alertes) }}
                                    {{ Form::hidden('baieID', $Alerte->id_baie) }}
                                <!-- --------------------------------------------------------- -->
                                    {!! Form::submit('ACQUITTER') !!}
                                {!! Form::close() !!}
                                @else
                                {{$Alerte->updated_at}}
                                @endif
                            </td>
                            <!-- --------------------- -->
                        </tr>
                    @endforeach                
            </tbody>
        </table>
        @else <!--  -->
            <p style="font-size: 20px; text-align: center">- Aucune alertes -</p>
        @endif

    </div>
    <!-- -------------------------------------------------------------------------- -->    
</div>

@endsection

@include('INC.Footer')