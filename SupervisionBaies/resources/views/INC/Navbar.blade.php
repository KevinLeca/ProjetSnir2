<nav class="navbar navbar-inverse" style="border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href=".">Supervision de Baies</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="MesuresB">Mesures<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a id="b" href="MesuresB">Bâtiment B</a></li>
                        <li><a id="c" href="MesuresC">Bâtiment C</a></li>
                        <li><a id="d" href="MesuresD">Bâtiment D</a></li>
                        <li><a id="f" href="MesuresF">Bâtiment F</a></li>
                        <li><a id="g" href="MesuresG">Bâtiment G</a></li>
                    </ul>
                </li>
                <li><a href="/SupervisionBaies/Alertes">Alertes</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://172.18.58.251/nagios">Nagios</a></li>
                <li><a href="/ConfigurationBaies">Configuration</a></li>
            </ul>
        </div>
    </div>
</nav>@show