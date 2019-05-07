@extends('layout.layout')

@section('content')
<hr style="color: #222222">
    <h1>Accueil</h1>
<hr style="color: #222222">

<table class="table table-bordered tableauAccueil">
        <tr>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle btn-block titre" data-toggle="dropdown">
                      Configuration des seuils des baies
                    </button>
                    <div class="dropdown-menu menuDeroulant">
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/baieB">Batiment B</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/baieC">Batiment C</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/baieD">Batiment D</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/baieF">Batiment F</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/baieG">Batiment G</a><br/>
                    </div>
                  </div>
                <br/>
             - Consulter les seuils de température et humidité de chaque baie.<br/>
             - Modifier ces seuils.
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle btn-block titre" data-toggle="dropdown">
                      Configuration des seuils des équipements
                    </button>
                    <div class="dropdown-menu menuDeroulant">
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/equipementB">Batiment B</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/equipementC">Batiment C</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/equipementD">Batiment D</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/equipementF">Batiment F</a><br/>
                      <a class="dropdown-item-text menuDeroulant" href="/ConfigurationBaies/equipementG">Batiment G</a><br/>
                    </div>
                  </div>
                <br/>
             - Consulter les seuils des équipements de chaque baie.<br/>
             - Modifier ces seuils.
            </td>
            <!--cellule à supprimer si la ligne en dessous n'est plus en commentaire-->
            <td>
                <div>
                    <a type="button" class="btn btn-block nav-link titre" href="/ConfigurationBaies/contacts">
                      Liste des contacts en cas d'alerte
                    </a>
                </div>
                <br/>
             - Consulter la liste des personnes à contacter en cas d'alerte.<br/>
             - Ajouter, modifier ou supprimer des contacts.
            </td>
        </tr>
        <!--ne pas la laisser en commentaire si on rajoute l'onglet "liste des "équipements" dans la navbar"-->
        <!--tr>
            <td>
                <div>
                    <a type="button" class="btn btn-block nav-link titre" href="/ConfigurationBaies/listeEquipements">
                      Liste des équipements
                    </a>
                </div>
                <br/>
             - Consulter la liste des équipements des baies.<br/>
             - Affecter une baie à chaque équipement.
            </td>
            <td>
                <div>
                    <a type="button" class="btn btn-block nav-link titre" href="/ConfigurationBaies/contacts">
                      Liste des contacts en cas d'alerte
                    </a>
                </div>
                <br/>
             - Consulter la liste des personnes à contacter en cas d'alerte.<br/>
             - Ajouter, modifier ou supprimer des contacts.
            </td>
        </tr-->
    </table>
@endsection