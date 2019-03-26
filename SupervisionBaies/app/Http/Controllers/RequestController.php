<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller {

    public function getMesures() {
        $Mesures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->join('baies', 'baies.id_baie', '=', 'mesures_baies.id_baie')
                ->select('mesures_baies.datetime', 'mesures_baies.temperature', 'mesures_baies.humidite')
                ->where('baies.id_baie', '=', '1')
                ->get();
        dd($Mesures);
        //return view('Mesures')->with('Mesures', $Mesures);
    }

    public function getAlertes() {
        $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 0)->sortByDesc('datetime');
        return view('Alertes')->with('Alertes', $Alertes);
    }

    public function getData() {
        return view('dataGraph');
    }

    public function acquitter(Request $request) {
        $idalerte = $request->alerteID;
        \App\Alertes::where('id_alertes', $idalerte)->update(['etat_alerte' => 1]);
        $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 0)->sortByDesc('datetime');
        return view('Alertes')->with('Alertes', $Alertes);
    }

    public function getAlertesRecherche(Request $request) {
        //Je recupere la date de début
        $dateStart = $request->input('date-start');
        $timeStart = $request->input('time-start');        
        if ($dateStart == "") {
            $dateStart = "0000-00-00";
        }
        if($timeStart == ""){
            $timeStart = "00:00:01";
        }
        $combinedDTStart = date('Y-m-d H:i:s', strtotime("$dateStart $timeStart"));

        //je recupere la date de fin
        $dateStop = $request->input('date-stop');
        $timeStop = $request->input('time-stop');        
        if ($dateStop == "") {
                $dateStop = date("Y-m-d");            
        }
        if($timeStop == ""){
            $timeStop = "00:00:00";
        }
        $combinedDTStop = date('Y-m-d H:i:s', strtotime("$dateStop $timeStop"));
        
        //Je vérifie l'etat de ma checkbox et selectionne mes alertes selon
        if ($request->input('checkbox') == 1) {
            $Alertes = \App\Alertes::all()->where('datetime', '>', $combinedDTStart)->where('datetime', '<', $combinedDTStop)->sortByDesc('datetime');
        } else {
            $Alertes = \App\Alertes::all()->where('etat_alerte', '=', 0)->where('datetime', '>', $combinedDTStart)->where('datetime', '<', $combinedDTStop)->sortByDesc('datetime');
        }
        
        //Je retourne ma vue
        return view('Alertes')->with('Alertes', $Alertes);
        
        /*
            $Mesures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->join('baies', 'baies.id_baie', '=', 'mesures_baies.id_baie')
                ->select('baies.batiment', 'mesures_baies.temperature', 'mesures_baies.humidite', 'mesures_baies.datetime')
                ->get();
        */
    }

}
