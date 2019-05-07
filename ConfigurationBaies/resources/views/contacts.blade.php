@extends('layout.layout')

@section('content')
<hr style="color: #222222">
    <h1>Contacts</h1>
    <hr style="color: #222222">
    
    <!------------- Affichage des messages d'erreur ------------->
    @include('inc.messages')
    <!----------------------------------------------------------->
    
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th style="text-align: center">Nom</th>
                <th style="text-align: center">Prénom</th>
                <th style="text-align: center">Adresse email</th>
                <th style="text-align: center">Numéro de portable</th>
                <th style="text-align: center" colspan="3">Action à effectuer</th>
            </tr>
        </thead>
        
        <tbody>
            <!------------------Ligne pour ajouter un contact------------------>
            <tr style="background-color: #bbb">
                {!! Form::open(['url' => 'addContact']) !!}
                <td><input type="text" name="nom"></td>
                <td><input type="text" name="prenom"></td>
                <td><input type="email" name="adresseEmail"></td>
                <td><input type="tel" name="portable"  pattern="[0-9]{10}"></td>
                <td colspan="3">
                    {{Form::submit('Ajouter',['class'=>'btn btn-button'])}}
                </td>
                {!! Form::close() !!}
            </tr>
            <!----------------------------------------------------------------->
            
            <!-----------------Affichage des contacts de la bdd---------------->
            @if(count($contacts) > 0)
                @foreach($contacts as $contact)
                <tr>
                    <!-------------------Modifier un contact------------------->
                    {!! Form::open(['url' => 'submitContact']) !!}
                    <td><input style="text-align: center" type="text" name="nomContact" value={{$contact->nom}}></td>
                    <td><input style="text-align: center" type="text" name="prenomContact" value={{$contact->prenom}}></td>
                    <td><input style="text-align: center" type="email" name="adresseEmailContact" value={{$contact->email}}></td>
                    <td><input style="text-align: center" type="tel" name="portableContact"  pattern="[0-9]{10}" value={{$contact->numero_telephone}}></td>
                    <td>
                        {{Form::hidden('idContact',$contact->id_contact)}}
                        {{Form::submit('Mettre à jour',['class'=>'btn btn-button'])}}
                    {!! Form::close() !!}
                    </td>
                    <!--------------------------------------------------------->
                    
                    <!----Annuler les modifications en rechargeant la page----->
                    <!--Inutile si on a appuyé sur le bouton "modifier" avant-->
                    <td>
                    {!! Form::open(['url' => 'reloadContact']) !!}
                        {{Form::submit('Réinitialiser',['class'=>'btn btn-button'])}}
                    {!! Form::close() !!}
                    </td>
                    <!--------------------------------------------------------->
                    
                    <!------------------Supprimer un contact------------------->
                    <td>
                    {!! Form::open(['url' => 'deleteContact']) !!}
                        {{Form::hidden('idContact',$contact->id_contact)}}
                        {{Form::submit('Supprimer',['class'=>'btn btn-button'])}}
                    {!! Form::close() !!}
                    </td>
                    <!--------------------------------------------------------->
                </tr>
                @endforeach
            @endif
            <!----------------------------------------------------------------->
        </tbody>
    </table>
@endsection

<!--si on clique sur "sélectionner", les champs de la ligne deviennent modifiable, et le bouton devient "modifier", et "supprimer" devient "annuler"-->