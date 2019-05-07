<?php

/**
 * @file BaieController.php
 * @brief fonctions relatives à la configuration des seuils des baies
 * @version 1.0
 * @author Élise COUSIN
 * @date 03/05/2019
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaieController extends Controller
{
    /**
     * @brief BaieController::getB
     * @details Selectionne tous les seuils de la baie B
     * @return Retourne la vue baieB contenant les seuils de la baie B
     */
    public function getB(){
        $idBatimentBaie=1; //id de la baie B = 1
        
        //requête des différents seuils de la baie
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_baie_temp_critique_mini','seuil_baie_temp_alerte_mini','seuil_baie_temp_alerte_maxi','seuil_baie_temp_critique_maxi','seuil_baie_hum_alerte','seuil_baie_hum_critique')
                ->where('id_baie', '=', $idBatimentBaie)
                ->get();
        
        //affichage de la vue avec les seuils correspondants
        return view('baieB')->with('seuilsBaie',$Seuils);
    }
    /*------------------------------------------------------------------------*/
    
    
    /**
     * @brief BaieController::getC
     * @details Selectionne tous les seuils de la baie C
     * @return Retourne la vue baieC contenant les seuils de la baie C
     */
    public function getC(){
        $idBatimentBaie=2; //id de la baie C = 2
        
        //requête des différents seuils de la baie
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_baie_temp_critique_mini','seuil_baie_temp_alerte_mini','seuil_baie_temp_alerte_maxi','seuil_baie_temp_critique_maxi','seuil_baie_hum_alerte','seuil_baie_hum_critique')
                ->where('id_baie', '=', $idBatimentBaie)
                ->get();
        
        //affichage de la vue avec les seuils correspondants
        return view('baieC')->with('seuilsBaie',$Seuils);
    }
    /*------------------------------------------------------------------------*/
    
    
    /**
     * @brief BaieController::getD
     * @details Selectionne tous les seuils de la baie D
     * @return Retourne la vue baieD contenant les seuils de la baie D
     */
    public function getD(){
        $idBatimentBaie=3; //id de la baie D = 3
        
        //requête des différents seuils de la baie
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_baie_temp_critique_mini','seuil_baie_temp_alerte_mini','seuil_baie_temp_alerte_maxi','seuil_baie_temp_critique_maxi','seuil_baie_hum_alerte','seuil_baie_hum_critique')
                ->where('id_baie', '=', $idBatimentBaie)
                ->get();
        
        //affichage de la vue avec les seuils correspondants
        return view('baieD')->with('seuilsBaie',$Seuils);
    }
    /*------------------------------------------------------------------------*/
    
    
    /**
     * @brief BaieController::getF
     * @details Selectionne tous les seuils de la baie F
     * @return Retourne la vue baieF contenant les seuils de la baie F
     */
    public function getF(){
        $idBatimentBaie=4; //id de la baie F = 4
        
        //requête des différents seuils de la baie
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_baie_temp_critique_mini','seuil_baie_temp_alerte_mini','seuil_baie_temp_alerte_maxi','seuil_baie_temp_critique_maxi','seuil_baie_hum_alerte','seuil_baie_hum_critique')
                ->where('id_baie', '=', $idBatimentBaie)
                ->get();
        
        //affichage de la vue avec les seuils correspondants
        return view('baieF')->with('seuilsBaie',$Seuils);
    }
    /*------------------------------------------------------------------------*/
    
    
    /**
     * @brief BaieController::getG
     * @details Selectionne tous les seuils de la baie G
     * @return Retourne la vue baieG contenant les seuils de la baie G
     */
    public function getG(){
        $idBatimentBaie=5; //id de la baie G = 5
        
        //requête des différents seuils de la baie
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_baie_temp_critique_mini','seuil_baie_temp_alerte_mini','seuil_baie_temp_alerte_maxi','seuil_baie_temp_critique_maxi','seuil_baie_hum_alerte','seuil_baie_hum_critique')
                ->where('id_baie', '=', $idBatimentBaie)
                ->get();
        
        //affichage de la vue avec les seuils correspondants
        return view('baieG')->with('seuilsBaie',$Seuils);
    }
    /*------------------------------------------------------------------------*/
    
    
    /**
     * @brief BaieController::majSeuilsBaies
     * @details Met à jour les seuils de la baie dans la BDD avec les valeurs inscrites dans les inputs
     * @param int $idBaie id de la baie sélectionnée et dont les seuils seront modifiés
     * @param int $baieTempCritiqueMini seuil critique minimal de température
     * @param int $baieTempAlerteMini seuil d'alerte minimal de température
     * @param int $baieTempAlerteMaxi seuil d'alerte maximal de température
     * @param int $baieTempCritique seuil critique maximal de température
     * @param int $baieHumAlerte seuil d'alerte d'humidité
     * @param int $baieHumCritique seuil critique d'humidité
     * @return Retourne la vue de la baie concernée avec les seuils mis à jour
     */
    public function majSeuilsBaies(Request $requete){
        $idBatimentBaie = $requete->idBaie; //récupération de l'id de la baie
        
        /*--vérification que tous les champs sont remplis, et message d'erreur si ce n'est pas le cas--*/
        $this->validate($requete, [
            'baieTempAlerteMini'=> 'required',
            'baieTempCritiqueMini'=> 'required',
            'baieTempAlerteMaxi'=> 'required',
            'baieTempCritiqueMaxi'=> 'required',
            'baieHumAlerte'=> 'required',
            'baieHumCritique'=> 'required']
        ,[
            'baieTempAlerteMini.required'=>"Le seuil d'alerte minimal de température est requis",
            'baieTempCritiqueMini.required'=>"Le seuil critique minimal de température est requis",
            'baieTempAlerteMaxi.required'=>"Le seuil d'alerte maximal de température est requis",
            'baieTempCritiqueMaxi.required'=>"Le seuil critique maximal de température est requis",
            'baieHumAlerte.required'=>"Le seuil d'alerte maximal d'humidité est requis",
            'baieHumCritique.required'=>"Le seuil critique maximal d'humidité est requis"
        ]);
        /*--------------------------------------------------------------------*/
        
        /*-----------------récupération des nouveaux seuils-------------------*/
        //inverse les seuils de température critiques et d'alerte minimals si le seuil critique est plus grand que le seuil d'alerte
        if (($requete->baieTempAlerteMini) < ($requete->baieTempCritiqueMini)){
            $tempAlerteMini=$requete->baieTempCritiqueMini;
            $tempCritiqueMini=$requete->baieTempAlerteMini;
        }else{
            $tempAlerteMini=$requete->baieTempAlerteMini;
            $tempCritiqueMini=$requete->baieTempCritiqueMini;
        }
        
        //inverse les seuils de température critiques et d'alerte maximals si le seuil critique est plus petit que le seuil d'alerte
        if (($requete->baieTempAlerteMaxi) > ($requete->baieTempCritiqueMaxi)){
            $tempAlerteMaxi=$requete->baieTempCritiqueMaxi;
            $tempCritiqueMaxi=$requete->baieTempAlerteMaxi; 
        }else{
            $tempAlerteMaxi=$requete->baieTempAlerteMaxi;
            $tempCritiqueMaxi=$requete->baieTempCritiqueMaxi;
        }
        
        //comparaison et inversion maximal / minimal si besoin
        if (($tempAlerteMini) > ($tempAlerteMaxi)){
            $alerteMaxi=$tempAlerteMini;
            $alerteMini=$tempAlerteMaxi;
        }else{
            $alerteMini=$tempAlerteMini;
            $alerteMaxi=$tempAlerteMaxi;
        }
        if (($tempCritiqueMini) > ($tempCritiqueMaxi)){
            $critiqueMaxi=$tempCritiqueMini;
            $critiqueMini=$tempCritiqueMaxi;
        }else{
            $critiqueMini=$tempCritiqueMini;
            $critiqueMaxi=$tempCritiqueMaxi;
        }

        //dernière comparaison et inversion alerte / critique si besoin
        if (($alerteMini) < ($critiqueMini)){
            $tempAlerteMini=$critiqueMini;
            $tempCritiqueMini=$alerteMini;
        }else{
            $tempAlerteMini=$alerteMini;
            $tempCritiqueMini=$critiqueMini;
        }
        
        if (($alerteMaxi) > ($critiqueMaxi)){
            $tempAlerteMaxi=$critiqueMaxi;
            $tempCritiqueMaxi=$alerteMaxi;
        }else{
            $tempCritiqueMaxi=$critiqueMaxi;
            $tempAlerteMaxi=$alerteMaxi;
        }
        
        //inverse les seuils d'humidité si le seuil critique est plus petit que le seuil d'alerte
        if (($requete->baieHumAlerte) < ($requete->baieHumCritique)){
            $humAlerte=$requete->baieHumAlerte;
            $humCritique=$requete->baieHumCritique;
        }else{
            $humAlerte=$requete->baieHumCritique;
            $humCritique=$requete->baieHumAlerte;
        }
        /*--------------------------------------------------------------------*/
        
        /*------------mise à jour des seuils dans la base de données----------*/
        \App\baies::where('id_baie', $idBatimentBaie)
                ->update(['seuil_baie_temp_critique_mini' => $tempCritiqueMini]);
        \App\baies::where('id_baie', $idBatimentBaie)
                ->update(['seuil_baie_temp_alerte_mini' => $tempAlerteMini]);
        \App\baies::where('id_baie', $idBatimentBaie)
                ->update(['seuil_baie_temp_alerte_maxi' => $tempAlerteMaxi]);
        \App\baies::where('id_baie', $idBatimentBaie)
                ->update(['seuil_baie_temp_critique_maxi' => $tempCritiqueMaxi]);
        \App\baies::where('id_baie', $idBatimentBaie)
                ->update(['seuil_baie_hum_alerte' => $humAlerte]);
        \App\baies::where('id_baie', $idBatimentBaie)
                ->update(['seuil_baie_hum_critique' => $humCritique]);
        /*--------------------------------------------------------------------*/
        
        //requête des différents seuils de la baie
        $Seuils = \Illuminate\Support\Facades\DB::table('baies')
                ->select('id_baie', 'seuil_baie_temp_critique_mini','seuil_baie_temp_alerte_mini','seuil_baie_temp_alerte_maxi','seuil_baie_temp_critique_maxi','seuil_baie_hum_alerte','seuil_baie_hum_critique')
                ->where('id_baie', '=', $idBatimentBaie)
                ->get();
        
        
        /*-----------recharge la page pour mettre le tableau à jour-----------*/
        if($idBatimentBaie == 1){
            //return redirect('baieB');
            return view('baieB')->with('seuilsBaie',$Seuils);
        }
        if($idBatimentBaie == 2){
            return view('baieC')->with('seuilsBaie',$Seuils);
        }
        if($idBatimentBaie == 3){
            return view('baieD')->with('seuilsBaie',$Seuils);
        }
        if($idBatimentBaie == 4){
            return view('baieF')->with('seuilsBaie',$Seuils);
        }
        if($idBatimentBaie == 5){
            return view('baieG')->with('seuilsBaie',$Seuils);
        }
        /*--------------------------------------------------------------------*/
    }
}
