<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Charts\MyChart;

class PagesController extends Controller {

    public function getHome() {
        $Home = \App\Baies::all();
        return view('Home')->with('Home', $Home);
    }

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
        
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '1')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '1')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '1')
                ->where('datetime', '>', $combinedDTStart)
                ->where('datetime', '<', $combinedDTStop)
                ->orderby('datetime', 'DESC')
                ->get();

        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);
        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);

        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);

        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->dataset("températures (°C)", "line", $newDataTemp);
        $chart->dataset("humidité (%)", "line", $newDataHum);

        return view('MesuresB', ['chart' => $chart]);
    }

    public function getB() {
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '1')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '1')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '1')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);
        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);

        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);

        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->dataset("températures (°C)", "line", $newDataTemp);
        $chart->dataset("humidité (%)", "line", $newDataHum);
        
        return view('MesuresB', ['chart' => $chart]);
    }

    public function getC() {
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '2')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '2')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '2')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);
        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);

        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);

        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->dataset("températures (°C)", "line", $newDataTemp);
        $chart->dataset("humidité (%)", "line", $newDataHum);

        return view('MesuresC', ['chart' => $chart]);
    }

    public function getD() {
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '3')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '3')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '3')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);
        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);

        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);

        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->dataset("températures (°C)", "line", $newDataTemp);
        $chart->dataset("humidité (%)", "line", $newDataHum);

        return view('MesuresD', ['chart' => $chart]);
    }

    public function getF() {
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '4')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '4')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '4')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);
        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);

        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);

        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->dataset("températures (°C)", "line", $newDataTemp);
        $chart->dataset("humidité (%)", "line", $newDataHum);

        return view('MesuresF', ['chart' => $chart]);
    }

    public function getG() {
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '5')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '5')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '5')
                ->orderby('datetime', 'DESC')
                ->limit('10')
                ->get();

        $dataTemp = array();
        foreach ($temperatures as $temp) {
            array_push($dataTemp, $temp->temperature);
        }
        $newDataTemp = array_reverse($dataTemp);
        
        $dataHum = array();
        foreach ($humidites as $humidite) {
            array_push($dataHum, $humidite->humidite);
        }
        $newDataHum = array_reverse($dataHum);

        $dataLabels = array();
        foreach ($labels as $label) {
            array_push($dataLabels, $label->datetime);
        }
        $newDataLabels = array_reverse($dataLabels);

        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($newDataLabels);
        $chart->dataset("températures (°C)", "line", $newDataTemp);
        $chart->dataset("humidité (%)", "line", $newDataHum);

        return view('MesuresG', ['chart' => $chart]);
    }

}
