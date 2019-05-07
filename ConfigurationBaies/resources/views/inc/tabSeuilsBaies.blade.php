<!-- tableau des seuils de la baie -->

<h3>Seuils actuels de la baie</h3>
    <table class="table table-bordered tableauBaies">
        @foreach($seuilsBaie as $seuilBaie)
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
                <b>Température minimale</b>
            </td>
            <td class="alerte_mini">
                {{$seuilBaie->seuil_baie_temp_alerte_mini}} °C <!--seuil récupéré dans la bdd-->
            </td>
            <td class="critique_mini">
                {{$seuilBaie->seuil_baie_temp_critique_mini}} °C <!--seuil récupéré dans la bdd-->
            </td>
        </tr>
        <tr>
            <td>
                <b>Température maximale</b>
            </td>
            <td class="alerte_maxi">
                {{$seuilBaie->seuil_baie_temp_alerte_maxi}} °C <!--seuil récupéré dans la bdd-->
            </td>
            <td class="critique_maxi">
                {{$seuilBaie->seuil_baie_temp_critique_maxi}} °C <!--seuil récupéré dans la bdd-->
            </td>
        </tr>
        <tr>
            <td>
                <b>Humidité</b>
            </td>
            <td class="alerte_maxi">
                {{$seuilBaie->seuil_baie_hum_alerte}} % <!--seuil récupéré dans la bdd-->
            </td>
            <td class="critique_maxi">
                {{$seuilBaie->seuil_baie_hum_critique}} % <!--seuil récupéré dans la bdd-->
            </td>
        </tr>
        @endforeach

    </table>