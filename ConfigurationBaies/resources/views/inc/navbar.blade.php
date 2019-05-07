<nav class="navbar navbar-inverse" style="border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/ConfigurationBaies">Configuration</a>
        </div>
        
        <!--------------------------barre de navigation------------------------>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <!------------------onglet "Seuils des baies"------------------>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/ConfigurationBaies">Seuils des baies<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <!--li><a id="b" href="/ConfigurationBaies">Bâtiment B</a></li-->
                        <li><a id="b" href="/ConfigurationBaies/baieB">Bâtiment B</a></li>
                        <li><a id="c" href="/ConfigurationBaies/baieC">Bâtiment C</a></li>
                        <li><a id="d" href="/ConfigurationBaies/baieD">Bâtiment D</a></li>
                        <li><a id="f" href="/ConfigurationBaies/baieF">Bâtiment F</a></li>
                        <li><a id="g" href="/ConfigurationBaies/baieG">Bâtiment G</a></li>
                    </ul>
                </li>
                <!------------------------------------------------------------->
                
                <!---------------onglet "Seuils des équipements"--------------->
               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href=".">Seuils des équipements<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a id="b" href="/ConfigurationBaies/equipementB">Bâtiment B</a></li>
                        <li><a id="c" href="/ConfigurationBaies/equipementC">Bâtiment C</a></li>
                        <li><a id="d" href="/ConfigurationBaies/equipementD">Bâtiment D</a></li>
                        <li><a id="f" href="/ConfigurationBaies/equipementF">Bâtiment F</a></li>
                        <li><a id="g" href="/ConfigurationBaies/equipementG">Bâtiment G</a></li>
                    </ul>
                </li>
                <!------------------------------------------------------------->
                
                <!-------------onglet "Liste des équipements"------------------>
                <!--si plus en commentaire, faire les modifications indiquées dans "accueil.blade.php"-->
                
                <!--li class="{{Request::is('listeEquipements') ? 'active' : ''}}"><a href="/ConfigurationBaies/listeEquipements">Liste des équipements</a></li-->
                
                <!--------------------onglet "Contacts"------------------------>
                <li class="{{Request::is('contacts') ? 'active' : ''}}"><a href="/ConfigurationBaies/contacts">Liste des contacts en cas d'alerte</a></li>
            </ul>
            
            <!-------liens vers l'application de supervision et le nagios------>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://172.18.58.22/nagios">Nagios</a></li>
                <li><a href="/SupervisionBaies">Supervision de Baies</a></li>
            </ul>
            <!------------------------------------------------------------->
        </div>
    </div>
</nav>