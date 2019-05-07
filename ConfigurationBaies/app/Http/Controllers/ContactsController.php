<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contacts;

class ContactsController extends Controller
{
    /**
     * @brief ContactsController::getContacts
     * @details Selectionne tous les contacts contenus dans la BDD
     * @return Retourne la vue listeEquipement contenant la liste de tous les équipements
     */
    public function getContacts(){
        $Contacts = \Illuminate\Support\Facades\DB::table('contacts')
                ->select('id_contact', 'nom','prenom','numero_telephone','email')
                ->get();
        
        return view('contacts')->with('contacts',$Contacts);
    }
    
    public function addContact(Request $requete){
        
        $this->validate($requete, [
            'nom'=> 'required',
            'prenom'=> 'required']
        ,[
            'nom.required'=>"Le nom est requis",
            'prenom.required'=>"Le prénom est requis"
        ]);
        
        $nom=$requete->nom;
        $prenom=$requete->prenom;
        $adresseEmail=$requete->adresseEmail;
        $portable=$requete->portable;
        
        //ajout d'une nouvelle ligne contenant les données du nouveau contact dans la BDD
        $contact=new contacts;
        $contact->nom=$nom;
        $contact->prenom=$prenom;
        $contact->numero_telephone=$portable;
        $contact->email=$adresseEmail;
        $contact->save();
        
        return redirect('contacts');
    }
    
    public function reloadContact(Request $requete){
        return redirect('contacts');        
    }
    
    public function majContact(Request $requete){
        $idContact = $requete->idContact;
        
        $nom = $requete->nomContact;
        $prenom = $requete->prenomContact;
        $adresseEmail = $requete->adresseEmailContact;
        $portable = $requete->portableContact;
        
        \App\contacts::where('id_contact', $idContact)
                ->update(['nom' => $nom]);
        \App\contacts::where('id_contact', $idContact)
                ->update(['prenom' => $prenom]);
        \App\contacts::where('id_contact', $idContact)
                ->update(['email' => $adresseEmail]);
        \App\contacts::where('id_contact', $idContact)
                ->update(['numero_telephone' => $portable]);
        
        return redirect('contacts');
    }
    
    public function deleteContact(Request $requete){
        $idContact = $requete->idContact;
        
        \App\contacts::where('id_contact', $idContact)
                ->delete();
        
        return redirect('contacts');
    }
}
