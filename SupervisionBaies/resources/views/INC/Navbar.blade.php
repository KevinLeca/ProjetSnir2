<nav class="navbar navbar-inverse" style="border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="/SupervisionBaies">Supervision de Baies</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <!-- Item mesures contenant les differentes baies -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href=".">Mesures<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a id="b" href="/SupervisionBaies/MesuresB">Bâtiment B</a></li>
                        <li><a id="c" href="/SupervisionBaies/MesuresC">Bâtiment C</a></li>
                        <li><a id="d" href="/SupervisionBaies/MesuresD">Bâtiment D</a></li>
                        <li><a id="f" href="/SupervisionBaies/MesuresF">Bâtiment F</a></li>
                        <li><a id="g" href="/SupervisionBaies/MesuresG">Bâtiment G</a></li>
                    </ul>
                </li>
                <!-- Item Alertes -->
                <li><a href="/SupervisionBaies/Alertes">Alertes</a></li>
            </ul>
            <!-- Item Pour accéder aux autres interfaces du projet -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://172.18.58.22/nagios">Nagios</a></li>
                <li><a href="/ConfigurationBaies">Configuration</a></li>
            </ul>
        </div>
    </div>
</nav>@show