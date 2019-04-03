<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Charts\MyChart;

class PagesController extends Controller
{
    public function getHome(){
        $Home = \App\Baies::all();
        return view('Home')->with('Home', $Home);
    }   
    
    public function getB(){
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '1')
                ->get();
        
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '1')
                ->get();
        
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '1')
                ->get();
        
        $dataTemp = array();
        foreach ($temperatures as $temp){
            array_push($dataTemp, $temp->temperature);
        }
        
        $dataHum = array();
        foreach ($humidites as $humidite){
            array_push($dataHum, $humidite->humidite);
        }
        
        $dataLabels = array();
        foreach ($labels as $label){
            array_push($dataLabels, $label->datetime);
        }
        
        $chart = new MyChart();
        $chart->title("Mesures bâtiment B");
        $chart->labels($dataLabels);
        $chart->dataset("températures (°C)", "line", $dataTemp);
        $chart->dataset("humidité (%)", "line", $dataHum);

        return view('MesuresB', ['chart' => $chart]);
    }   
    
    public function getC(){
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '2')
                ->get();
        
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '2')
                ->get();
        
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '2')
                ->get();
        
        $dataTemp = array();
        foreach ($temperatures as $temp){
            array_push($dataTemp, $temp->temperature);
        }
        
        $dataHum = array();
        foreach ($humidites as $humidite){
            array_push($dataHum, $humidite->humidite);
        }
        
        $dataLabels = array();
        foreach ($labels as $label){
            array_push($dataLabels, $label->datetime);
        }
        
        $chart = new MyChart();
        $chart->title("Mesures bâtiment C");
        $chart->labels($dataLabels);
        $chart->dataset("températures (°C)", "line", $dataTemp);
        $chart->dataset("humidité (%)", "line", $dataHum);

        return view('MesuresC', ['chart' => $chart]);
    }   
    
    public function getD(){
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '3')
                ->get();
        
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '3')
                ->get();
        
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '3')
                ->get();
        
        $dataTemp = array();
        foreach ($temperatures as $temp){
            array_push($dataTemp, $temp->temperature);
        }
        
        $dataHum = array();
        foreach ($humidites as $humidite){
            array_push($dataHum, $humidite->humidite);
        }
        
        $dataLabels = array();
        foreach ($labels as $label){
            array_push($dataLabels, $label->datetime);
        }
        
        $chart = new MyChart();
        $chart->title("Mesures bâtiment D");
        $chart->labels($dataLabels);
        $chart->dataset("températures (°C)", "line", $dataTemp);
        $chart->dataset("humidité (%)", "line", $dataHum);

        return view('MesuresD', ['chart' => $chart]);
    }   
    
    public function getF(){
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '4')
                ->get();
        
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '4')
                ->get();
        
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '4')
                ->get();
        
        $dataTemp = array();
        foreach ($temperatures as $temp){
            array_push($dataTemp, $temp->temperature);
        }
        
        $dataHum = array();
        foreach ($humidites as $humidite){
            array_push($dataHum, $humidite->humidite);
        }
        
        $dataLabels = array();
        foreach ($labels as $label){
            array_push($dataLabels, $label->datetime);
        }
        
        $chart = new MyChart();
        $chart->title("Mesures bâtiment F");
        $chart->labels($dataLabels);
        $chart->dataset("températures (°C)", "line", $dataTemp);
        $chart->dataset("humidité (%)", "line", $dataHum);

        return view('MesuresF', ['chart' => $chart]);
    }   
    
    public function getG(){
        $labels = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('datetime')
                ->where('id_baie', '=', '5')
                ->get();
        
        $temperatures = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('temperature')
                ->where('id_baie', '=', '5')
                ->get();
        
        $humidites = \Illuminate\Support\Facades\DB::table('mesures_baies')
                ->select('humidite')
                ->where('id_baie', '=', '5')
                ->get();
        
        $dataTemp = array();
        foreach ($temperatures as $temp){
            array_push($dataTemp, $temp->temperature);
        }
        
        $dataHum = array();
        foreach ($humidites as $humidite){
            array_push($dataHum, $humidite->humidite);
        }
        
        $dataLabels = array();
        foreach ($labels as $label){
            array_push($dataLabels, $label->datetime);
        }
        
        $chart = new MyChart();
        $chart->title("Mesures bâtiment G");
        $chart->labels($dataLabels);
        $chart->dataset("températures (°C)", "line", $dataTemp);
        $chart->dataset("humidité (%)", "line", $dataHum);

        return view('MesuresG', ['chart' => $chart]);
    }   
}
