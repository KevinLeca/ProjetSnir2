<!------ Formulaire de configuration des seuils de la baie ------>

    @foreach($seuilsBaie as $seuilBaie)
    {!! Form::open(['url' => 'submitBaie']) !!}
    
    <!------------- Affichage des messages d'erreur ------------->
    @include('inc.messages')
    <!------------------------------------------------------------------------->
        
    <!--les valeurs affichées dans chaque "input" sont récupérées dans la BDD-->    
    <!-----------------------------température--------------------------------->
    <h3>Seuils de température</h3>
    <table class="table table-bordered tableauBaies">
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
                <input class="valeur" type="number" name="baieTempAlerteMini" min="-20" max="20" value={{$seuilBaie->seuil_baie_temp_alerte_mini}} title="Doit être inférieur au seuil d'alerte maximal et supérieur au seuil critique minimal">
            </td>
            <td class="critique_mini">
                <input class="valeur" type="number" name="baieTempCritiqueMini" min="-20" max="20" value={{$seuilBaie->seuil_baie_temp_critique_mini}} title="Doit être inférieur au seuil d'alerte minimal">
            </td>
        </tr>
        <tr>
            <td>
                <b>Maximal</b>
            </td>
            <td class="alerte_maxi">
                <input class="valeur" type="number" name="baieTempAlerteMaxi" min="0" max="100" value={{$seuilBaie->seuil_baie_temp_alerte_maxi}} title="Doit être inférieur au seuil critique maximal et supérieur au seuil d'alerte minimal">
            </td>
            <td class="critique_maxi">
                <input class="valeur" type="number" name="baieTempCritiqueMaxi" min="0" max="100" value={{$seuilBaie->seuil_baie_temp_critique_maxi}} title="Doit être supérieur au seuil d'alerte maximal">
            </td>
        </tr>
    </table>
    <!------------------------------------------------------------------------->
    
    <!------------------------------humidité----------------------------------->
    <h3>Seuils d'humidité</h3>
    <table class="table table-bordered">
        <tr>
            <td>
                <b>Alerte</b>
            </td>
            <td>
                <b>Critique</b>
            </td>
        </tr>
        <tr>
            <td class="alerte_maxi">
                <input class="valeur3" type="number" name="baieHumAlerte" min="0" max="100" value={{$seuilBaie->seuil_baie_hum_alerte}} title="Doit être inférieur au seuil critique">
            </td>
            <td class="critique_maxi">
                <input class="valeur3" type="number" name="baieHumCritique" min="0" max="100" value={{$seuilBaie->seuil_baie_hum_critique}} title="Doit être supérieur au seuil d'alerte">
            </td>
        </tr>
    </table>
    <!------------------------------------------------------------------------->
    
    <!---------------------------bouton configurer----------------------------->
    {{Form::hidden('idBaie',$seuilBaie->id_baie)}}
    {{Form::submit('Configurer',['class'=>'btn btn-button'])}}
    <!------------------------------------------------------------------------->
  
    {!! Form::close() !!}
    
    @endforeach

