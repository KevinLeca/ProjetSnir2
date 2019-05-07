<?php

/**
 * @file EquipementController.php
 * @brief fonctions relatives à la configuration des seuils des équipements des baies
 * @version 1.0
 * @author Élise COUSIN
 * @date 06/05/2019
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipementController extends Controller
{
    /**
     * @brief EquipementController::getB
     * @details Selectionne tous les seuils des équipements la baie B
     * @return Retourne la vue "baieB" contenant les seuils des équipements la baie B
     */    
    public function getB(){
        $idBatimentEquipement=1;
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_equipement_critique_mini','seuil_equipement_alerte_mini','seuil_equipement_alerte_maxi','seuil_equipement_critique_maxi')
                ->where('id_baie', '=', $idBatimentEquipement)
                ->get();
        
        return view('equipementB')->with('seuilsEquipement',$Seuils);
    }
    
    /**
     * @brief EquipementController::getC
     * @details Selectionne tous les seuils des équipements la baie C
     * @return Retourne la vue "baieC" contenant les seuils des équipements la baie C
     */
    public function getC(){
        $idBatimentEquipement=2;
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_equipement_critique_mini','seuil_equipement_alerte_mini','seuil_equipement_alerte_maxi','seuil_equipement_critique_maxi')
                ->where('id_baie', '=', $idBatimentEquipement)
                ->get();
        
        return view('equipementC')->with('seuilsEquipement',$Seuils);
    }
    
    /**
     * @brief EquipementController::getD
     * @details Selectionne tous les seuils des équipements la baie D
     * @return Retourne la vue "baieD" contenant les seuils des équipements la baie D
     */
    public function getD(){
        $idBatimentEquipement=3;
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_equipement_critique_mini','seuil_equipement_alerte_mini','seuil_equipement_alerte_maxi','seuil_equipement_critique_maxi')
                ->where('id_baie', '=', $idBatimentEquipement)
                ->get();
        
        return view('equipementD')->with('seuilsEquipement',$Seuils);
    }
    
    /**
     * @brief EquipementController::getF
     * @details Selectionne tous les seuils des équipements la baie F
     * @return Retourne la vue "baieF" contenant les seuils des équipements la baie F
     */
    public function getF(){
        $idBatimentEquipement=4;
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_equipement_critique_mini','seuil_equipement_alerte_mini','seuil_equipement_alerte_maxi','seuil_equipement_critique_maxi')
                ->where('id_baie', '=', $idBatimentEquipement)
                ->get();
        
        return view('equipementF')->with('seuilsEquipement',$Seuils);
    }
    
    /**
     * @brief EquipementController::getG
     * @details Selectionne tous les seuils des équipements la baie G
     * @return Retourne la vue "baieG" contenant les seuils des équipements la baie G
     */
    public function getG(){
        $idBatimentEquipement=5;
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_equipement_critique_mini','seuil_equipement_alerte_mini','seuil_equipement_alerte_maxi','seuil_equipement_critique_maxi')
                ->where('id_baie', '=', $idBatimentEquipement)
                ->get();
        
        return view('equipementG')->with('seuilsEquipement',$Seuils);
    }
    
    /**
     * @brief EquipementController::majSeuilsEquipements
     * @details Met à jour les seuils de la baie dans la BDD avec les valeurs inscrites dans les inputs
     * @param int $idEquipement id de la baie sélectionnée et dont les seuils des équimpements seront modifiés
     * @param int $equipementCritiqueMini seuil critique minimal de température
     * @param int $equipementAlerteMini seuil d'alerte minimal de température
     * @param int $equipementAlerteMaxi seuil d'alerte maximal de température
     * @param int $equipementCritique seuil critique maximal de température
     * @return Retourne la vue de la baie concernée avec les seuils mis à jour
     */
    public function majSeuilsEquipements(Request $requete){
        //récupération de l'id de la baie
        $idBatimentEquipement = $requete->idEquipement;
        
        $this->validate($requete, [
            'equipementAlerteMini'=> 'required',
            'equipementCritiqueMini'=> 'required',
            'equipementAlerteMaxi'=> 'required',
            'equipementCritiqueMaxi'=> 'required']
        ,[
            'equipementAlerteMini.required'=>"Le seuil d'alerte minimal est requis",
            'equipementCritiqueMini.required'=>"Le seuil critique minimal est requis",
            'equipementAlerteMaxi.required'=>"Le seuil d'alerte maximal est requis",
            'equipementCritiqueMaxi.required'=>"Le seuil critique maximal est requis"
        ]);
        
        
        //inverse les seuils de température critiques et d'alerte minimals si le seuil critique est plus grand que le seuil d'alerte
        if (($requete->equipementAlerteMini) < ($requete->equipementCritiqueMini)){
            $alerteMini=$requete->equipementCritiqueMini;
            $critiqueMini=$requete->equipementAlerteMini;
        }
        else{
            $alerteMini=$requete->equipementAlerteMini;
            $critiqueMini=$requete->equipementCritiqueMini;
        }
        
        //inverse les seuils de température critiques et d'alerte maximals si le seuil critique est plus petit que le seuil d'alerte
        if (($requete->equipementAlerteMaxi) > ($requete->equipementCritiqueMaxi)){
            $alerteMaxi=$requete->equipementCritiqueMaxi;
            $critiqueMaxi=$requete->equipementAlerteMaxi; 
        }
        else{
            $alerteMaxi=$requete->equipementAlerteMaxi;
            $critiqueMaxi=$requete->equipementCritiqueMaxi;
        }
        
        //comparaison et inversion maximal / minimal si besoin
        if (($alerteMini) > ($alerteMaxi)){
            $alMaxi=$alerteMini;
            $alMini=$alerteMaxi;
        }
        else{
            $alMini=$alerteMini;
            $alMaxi=$alerteMaxi;
        }
        
        if (($critiqueMini) > ($critiqueMaxi)){
            $critMaxi=$critiqueMini;
            $critMini=$critiqueMaxi;
        }
        else{
            $critMini=$critiqueMini;
            $critMaxi=$critiqueMaxi;
        }

        //dernière comparaison et inversion alerte / critique si besoin
        if (($alMini) < ($critMini)){
            $alerteMini=$critMini;
            $critiqueMini=$alMini;
        }
        else{
            $alerteMini=$alMini;
            $critiqueMini=$critMini;
        }
        
        if (($alMaxi) > ($critMaxi)){
            $alerteMaxi=$critMaxi;
            $critiqueMaxi=$alMaxi;
        }
        else{
            $critiqueMaxi=$critMaxi;
            $alerteMaxi=$alMaxi;
        }
        
        
        //mise à jour des seuils des équipements dans la base de données
        \App\baies::where('id_baie', $idBatimentEquipement)
                ->update(['seuil_equipement_critique_mini' => $critiqueMini]);
        \App\baies::where('id_baie', $idBatimentEquipement)
                ->update(['seuil_equipement_alerte_mini' => $alerteMini]);
        \App\baies::where('id_baie', $idBatimentEquipement)
                ->update(['seuil_equipement_alerte_maxi' => $alerteMaxi]);
        \App\baies::where('id_baie', $idBatimentEquipement)
                ->update(['seuil_equipement_critique_maxi' => $critiqueMaxi]);
        
        //mise à jour des seuils du tableau
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
               ->select('id_baie', 'seuil_equipement_critique_mini','seuil_equipement_alerte_mini','seuil_equipement_alerte_maxi','seuil_equipement_critique_maxi')
                ->where('id_baie', '=', $idBatimentEquipement)
                ->get();
        
        if($idBatimentEquipement == 1){
            return view('equipementB')->with('seuilsEquipement',$Seuils);
        }
        if($idBatimentEquipement == 2){
            return view('equipementC')->with('seuilsEquipement',$Seuils);
        }
        if($idBatimentEquipement == 3){
            return view('equipementD')->with('seuilsEquipement',$Seuils);
        }
        if($idBatimentEquipement == 4){
            return view('equipementF')->with('seuilsEquipement',$Seuils);
        }
        if($idBatimentEquipement == 5){
            return view('equipementG')->with('seuilsEquipement',$Seuils);
        }
        else{
            return redirect('accueil');
        }
    }
}
