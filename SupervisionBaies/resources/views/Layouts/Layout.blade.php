<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Supervision</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
        <!-- <script src="script.js"></script> -->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!-- For the charts -->	
        <script src="http://code.highcharts.com/highcharts.js"></script> 
        <script src="https://code.highcharts.com/highcharts-more.js"></script>  
        <script src="http://code.highcharts.com/modules/exporting.js"></script> 
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
    </head>



    <body>
        @include('INC.Navbar') <!-- Inclusion de la barre de navigation -->
        @yield('content')   <!-- emplacement du contenue, soit mes vues.blade.php -->
    </body>
</html>