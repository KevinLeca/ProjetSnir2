<?php

/**
 * @file PagesController.php
 * @brief fonctions relatives aux Mesures et la page d'accueil 
 * @version 1.0
 * @author Kévin LECA
 * @date 03/05/2019
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Charts\MyChart;

class PagesController extends Controller {

    /**
     * @brief PagesController::getHome
     * @details Selectionne toute les informations relatives aux baies
     * @return Retourne la vue Home ainsi que les informations relatives aux baies
     */
    public function getHome() {
        //Selection des information relatives aux baies
        $Home = \App\Baies::all();
        //Retour de la vue avec les informations
        return view('Home')->with('Home', $Home);
    }

    /**
     * @brief PagesController::getBRecherche
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @param int $dateDebut date de début de la fourchette
     * @param int $dateFin date de fin de la fourchette
     * @param int $heureDebut heure de début de la fourchette
     * @param int $heureFin heure de fin de la fourchette
     * @return Retourne la vue MesuresB avec les mesures concernées
     */
    public function getBRecherche(Request $request){
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
        
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '1')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des températures 
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '1')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection dfes taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '1')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp); //Inversion de la position des valeurs
                                                 //Pour les ranger dans l'ordre croissant de dates
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresB', ['chart' => $chart]);
    }
    
    /**
     * @brief PagesController::getCRecherche
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @param int $dateDebut date de début de la fourchette
     * @param int $dateFin date de fin de la fourchette
     * @param int $heureDebut heure de début de la fourchette
     * @param int $heureFin heure de fin de la fourchette
     * @return Retourne la vue MesuresC avec les mesures concernées
     */
    public function getCRecherche(Request $request){
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
        
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '2')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '2')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '2')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */
        
        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment C");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresC', ['chart' => $chart]);
    }
    
    /**
     * @brief PagesController::getDRecherche
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @param int $dateDebut date de début de la fourchette
     * @param int $dateFin date de fin de la fourchette
     * @param int $heureDebut heure de début de la fourchette
     * @param int $heureFin heure de fin de la fourchette
     * @return Retourne la vue MesuresD avec les mesures concernées
     */
    public function getDRecherche(Request $request){
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
        
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '3')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '3')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des taux d'umidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '3')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment D");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);
        
        //Retour de la vue avec le graphique
        return view('MesuresD', ['chart' => $chart]);
    }
    
    /**
     * @brief PagesController::getFRecherche
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @param int $dateDebut date de début de la fourchette
     * @param int $dateFin date de fin de la fourchette
     * @param int $heureDebut heure de début de la fourchette
     * @param int $heureFin heure de fin de la fourchette
     * @return Retourne la vue MesuresF avec les mesures concernées
     */
    public function getFRecherche(Request $request){
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
        
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '4')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '4')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '4')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment F");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresF', ['chart' => $chart]);
    }
    
    /**
     * @brief PagesController::getGRecherche
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @param int $dateDebut date de début de la fourchette
     * @param int $dateFin date de fin de la fourchette
     * @param int $heureDebut heure de début de la fourchette
     * @param int $heureFin heure de fin de la fourchette
     * @return Retourne la vue MesuresG avec les mesures concernées
     */
    public function getGRecherche(Request $request){
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
        
        //Selection des dates (labeles en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '5')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '5')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '5')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment G");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        return view('MesuresG', ['chart' => $chart]);
    }

    /**
     * @brief PagesController::getB
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @return Retourne la vue MesuresB avec les mesures relatives à la baie
     */
    public function getB() {
        //Selections des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '1')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '1')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '1')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);
        
        //Retour de la vue avec le graphique
        return view('MesuresB', ['chart' => $chart]);
    }

    /**
     * @brief PagesController::getC
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @return Retourne la vue MesuresC avec les mesures relatives à la baie
     */
    public function getC() {
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '2')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '2')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '2')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment C");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresC', ['chart' => $chart]);
    }

    /**
     * @brief PagesController::getD
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @return Retourne la vue MesuresD avec les mesures relatives à la baie
     */
    public function getD() {
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '3')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '3')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '3')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs      
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment D");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresD', ['chart' => $chart]);
    }

    /**
     * @brief PagesController::getF
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @return Retourne la vue MesuresF avec les mesures relatives à la baie
     */
    public function getF() {
        //Selection des dates (labels en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '4')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '4')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '4')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment F");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresF', ['chart' => $chart]);
    }

    /**
     * @brief PagesController::getG
     * @details Selectionne les mesures de la baie B selon les dates selectionnées
     * @return Retourne la vue MesuresG avec les mesures relatives à la baie
     */
    public function getG() {
        //Selection des dates (laberls en x)
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '5')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selection des températures
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '5')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        //Selections des taux d'humidite
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '5')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        /* Conversion des resultats de requête de objet JSON en tableau */
        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);//Inversion de la position des valeurs
                                                //Pour les ranger dans l'ordre croissant de dates        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);//Inversion de la position des valeurs
                                              //Pour les ranger dans l'ordre croissant de dates
        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);//Inversion de la position des valeurs
                                                    //Pour les ranger dans l'ordre croissant de dates
        /* ------------------------------------------------------------ */

        //Creation du graphique pour l'affichages des mesures
        $chart = new MyChart();
        $chart->title("Mesures bâtiment G");
        $chart->labels($newDataLabels);
        $chart->label("Valeurs");
        $chart->dataset("températures (°C)", "line", $newDataTemp)->options(['color' => '#f8906c',]);
        $chart->dataset("humidité (%)", "line", $newDataHum)->options(['color' => '#6cadf8',]);

        //Retour de la vue avec le graphique
        return view('MesuresG', ['chart' => $chart]);
    }

}
