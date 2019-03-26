<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getHome(){
        $Home = \App\Baies::all();
        return view('Home')->with('Home', $Home);
    }   
    
    public function getB(){
        return view('MesuresB');
    }   
    
    public function getC(){
        return view('MesuresC');
    }   
    
    public function getD(){
        return view('MesuresD');
    }   
    
    public function getF(){
        return view('MesuresF');
    }   
    
    public function getG(){
        return view('MesuresG');
    }   
}
