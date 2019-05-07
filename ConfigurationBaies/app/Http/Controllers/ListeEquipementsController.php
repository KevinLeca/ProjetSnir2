<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListeEquipementsController extends Controller
{
    /**
     * @brief ListeEquipementsController::getListeEquipements
     * @details Selectionne tous les équipements contenus dans la BDD
     * @return Retourne la vue "listeEquipement" contenant la liste de tous les équipements
     */
    public function getListeEquipements(){
        $Equipements = \Illuminate\Support\Facades\DB::table('equipements')
                ->select('id_equipement', 'adresse_ip','nom_equipement','id_baie')
                ->get();
        
        return view('listeEquipements')->with('listeEquipement',$Equipements);
    }
    
    /**
     * @brief ListeEquipementsController::majListeEquipements
     * @details Met à jour la localisation de l'équipement
     * @param int $idEquipement id de l'équipement dont l'id de la baie sera modifié
     * @param int $idBaie nouvel id de la baie dans laquelle se trouve l'équipement
     * @return Retourne la vue "listeEquipements" avec la localisation de l'équipement mise à jour
     */
    public function majListeEquipements(Request $requete){
        $idEquipement = $requete->idEquipement;
        $idBaie=$requete->baieEquipement;
        
        //met à jour, dans la BDD, l'id de la baie à laquelle appartient l'équipement
        \App\equipements::where('id_equipement', $idEquipement)
                ->update(['id_baie' => $idBaie]);
        
        return redirect('listeEquipements');
    }
}