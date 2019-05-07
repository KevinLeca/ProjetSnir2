<!------------------- Affichage des messages d'erreur ------------------>
@include('inc.messages')

<!---------- Formulaire de configuration des seuils de la baie ---------->


    @foreach($seuilsEquipement as $seuilEquipement)
    {!! Form::open(['url' => 'submitEquipement']) !!}
        
    <!-- température -->
    <h3>Seuils de température</h3>
    <table class="table table-bordered tableauEquipements">
        <tr>
            <td></td>
            <td>
                <b>Alerte</b>
            </td>
            <td>
                <b>Critique</b>
            </td>
        </tr>
        <tr>
            <td>
                <b>Minimal</b>
            </td>
            <td class="alerte_mini">
                <input class="valeur2" type="number" name="equipementAlerteMini" min="-20" max="20" value={{$seuilEquipement->seuil_equipement_alerte_mini}}>
            </td>
            <td class="critique_mini">
                <input class="valeur2" type="number" name="equipementCritiqueMini" min="-20" max="20" value={{$seuilEquipement->seuil_equipement_critique_mini}}>
            </td>
        </tr>
        <tr>
            <td>
                <b>Maximal</b>
            </td>
            <td class="alerte_maxi">
                <input class="valeur2" type="number" name="equipementAlerteMaxi" min="0" max="100" value={{$seuilEquipement->seuil_equipement_alerte_maxi}}>
            </td>
            <td class="critique_maxi">
                <input class="valeur2" type="number" name="equipementCritiqueMaxi" min="0" max="100" value={{$seuilEquipement->seuil_equipement_critique_maxi}}>
            </td>
        </tr>
    </table>
    <!------------------------------------------------------>
    
    <!-- bouton configurer -->
        {{Form::hidden('idEquipement',$seuilEquipement->id_baie)}}
        {{Form::submit('Configurer pour cette baie',['class'=>'btn btn-button'])}}
    <!------------------------------------------------------>
    {!! Form::close() !!}
    
    @endforeach

