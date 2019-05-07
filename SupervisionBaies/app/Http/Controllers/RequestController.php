<?php

/**
 * @file RequestController.php
 * @brief fonctions relatives aux alertes
 * @version 1.0
 * @author Kévin LECA
 * @date 03/05/2019
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MyChart;

class RequestController extends Controller {

    /**
     * @brief RequestController::getAlertes
     * @details Selectionne les alertes actives 
     * @return Retourne la vue Alertes avec un objet contenant les alertes actives
     */
    public function getAlertes() {
        // Requête pour récupérer toute les alertes non acquittées 
        $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 0)->sortByDesc('datetime');
        // Retour de la ve avec la variable contenant mes alertes
        return view('Alertes')->with('Alertes', $Alertes);
    }

    /**
     * @brief RequestController::acquitter
     * @param int $id_alerte ID de l'alerte à acquitter
     * @details Acquitte l'alerte correspondante
     * @return Retourne la vue Alertes 
     */
    public function acquitter(Request $request) {
        // Recuperation des informations depuis le formulaire de ma vue Alertes
        $idalerte = $request->alerteID;
        $idbaie = $request->baieID;
        // Mise à jour de l'alerte à acquitter dans la base de données
        \App\Alertes::where('id_alertes', $idalerte)->update(['etat_alerte' => 1]);
        // Recuperation des alertes non acquittées à retourner dans la vue
        $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 0)->sortByDesc('datetime');
        // Recuperation du nombre d'alertes concernant la baie pour laquelle l'alerte est acquitée
        $nbAlertes = \App\Alertes::all()->where('id_baie', $idbaie)->where('etat_alerte', 0)->count();
        // Mise à jour de l'état de la baie si il n'y a plus d'alertes
        if ($nbAlertes == 0) {
            \App\Baies::where('id_baie', $idbaie)->update(['etat_baie' => 0]);
        }
        // Retour de la vue Alertes avec les alertes non acquitées restantes
        //return view('Alertes')->with('Alertes', $Alertes);
        // Redirection necessaire pour pouvoir acquitter plusieurs alertes à la suite
        return redirect('Alertes');
    }

    /**
     * @brief RequestController::getAlertesRecherche
     * @param int $dateDebut date de début de la fourchette
     * @param int $dateFin date de fin de la fourchette
     * @param int $heureDebut heure de début de la fourchette
     * @param int $heureFin heure de fin de la fourchette
     * @return Retourne la vue Alertes avec les alertes selectionnées selon les critères de dates
     */
    public function getAlertesRecherche(Request $request) {
        // Je recupere la date de début
        $dateStart = $request->input('date-start');
        $timeStart = $request->input('time-start');
        // Si aucune date n'est renseignée, je la met à 0000-00-00
        if ($dateStart == "") {
            $dateStart = "0000-00-00";
        }
        // Si aucun timer n'est renseigné, je le met également à 00:00:00
        if ($timeStart == "") {
            $timeStart = "00:00:00";
        }
        // Je combine la date et le timer en datetime
        $combinedDTStart = date('Y-m-d H:i:s', strtotime("$dateStart $timeStart"));

        //je recupere la date de fin
        $dateStop = $request->input('date-stop');
        $timeStop = $request->input('time-stop');
        // Si aucune date n'est renseignée, je la met à la date du jour
        if ($dateStop == "") {
            $dateStop = date("Y-m-d");
        }
        // Si aucun timer n'est renseigné, je le met à la fin de la journée
        if ($timeStop == "") {
            $timeStop = "23:59:59";
        }
        // Je combine la date et le timer en datetime
        $combinedDTStop = date('Y-m-d H:i:s', strtotime("$dateStop $timeStop"));

        //On verifie si la date de debut est bien inferieure a la date de fin
        if ($combinedDTStart > $combinedDTStop) {
            //J'inverse les dates si la dateDebut est superier a la date de fin
            $tmp = $combinedDTStart;
            $combinedDTStart = $combinedDTStop;
            $combinedDTStop = $tmp;
        }

        //Je vérifie l'etat de ma checkbox et selectionne mes alertes selon cet état et l'interval de dates
        if ($request->input('checkbox') == 1) {
            $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 1)->where('datetime', '>', $combinedDTStart)->where('datetime', '<', $combinedDTStop)->sortByDesc('datetime');
        } else {
            $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 0)->where('datetime', '>', $combinedDTStart)->where('datetime', '<', $combinedDTStop)->sortByDesc('datetime');
        }

        //Je retourne ma vue
        return view('Alertes')->with('Alertes', $Alertes);
    }

}
