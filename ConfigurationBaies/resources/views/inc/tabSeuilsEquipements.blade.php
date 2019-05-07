<!-- tableau des seuils des équipements-->

<h3>Seuils actuels des équipements</h3>
    <table class="table table-bordered tableauEquipements">
        @foreach($seuilsEquipement as $seuilEquipement)
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
                {{$seuilEquipement->seuil_equipement_alerte_mini}} °C
            </td>
            <td class="critique_mini">
                {{$seuilEquipement->seuil_equipement_critique_mini}} °C
            </td>
        </tr>
        <tr>
            <td>
                <b>Température maximale</b>
            </td>
            <td class="alerte_maxi">
                {{$seuilEquipement->seuil_equipement_alerte_maxi}} °C
            </td>
            <td class="critique_maxi">
                {{$seuilEquipement->seuil_equipement_critique_maxi}} °C
            </td>
        </tr>
        @endforeach

    </table>