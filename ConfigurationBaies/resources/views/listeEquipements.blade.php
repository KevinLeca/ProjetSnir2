@extends('layout.layout')

@section('content')
<hr style="color: #222222">
    <h1>Liste des équipements</h1>
    <hr style="color: #222222">
    
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th style="text-align: center">Nom de l'équipement</th>
                <th style="text-align: center">Adresse IP</th>
                <th style="text-align: center">Localisation de l'équipement</th>
                <th style="text-align: center" colspan="2">Modifier la localisation : </th>
            </tr>
        </thead>
        
        <tbody>
            @if(count($listeEquipement) > 0)
                @foreach($listeEquipement as $equipement)
                <tr>
                    <td>{{$equipement->nom_equipement}}</td>
                    <td>{{$equipement->adresse_ip}}</td>
                    @if($equipement->id_baie == 1)
                        <td>Bâtiment B</td>
                    @elseif($equipement->id_baie == 2)
                        <td>Bâtiment C</td>
                    @elseif($equipement->id_baie == 3)
                        <td>Bâtiment D</td>
                    @elseif($equipement->id_baie == 4)
                        <td>Bâtiment F</td>
                    @elseif($equipement->id_baie == 5)
                        <td>Bâtiment G</td>
                    @else
                        <td></td>
                    @endif
                    {!! Form::open(['url' => 'submitListeEquipements']) !!}
                    <td>
                        <select id="baieEquipement" name="baieEquipement">
                            <option value="1">Bâtiment B</option>
                            <option value="2">Bâtiment C</option>
                            <option value="3">Bâtiment D</option>
                            <option value="4">Bâtiment F</option>
                            <option value="5">Bâtiment G</option>
                        </select> 
                    </td>
                    <td>
                        {{Form::hidden('idEquipement',$equipement->id_equipement)}}
                        {{Form::submit('Modifier',['class'=>'btn btn-button'])}}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
@endsection