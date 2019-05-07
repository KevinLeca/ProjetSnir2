<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Configuration</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
        <!-- <script src="script.js"></script> -->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!-- CSS -->
       <link href="../../../public/css/app.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <style>
        .table {
            text-align: center;
            border-width: 2px;
            border-color: #a0a0a0;
        }
        .tableauBaies {
            height: 155px;
        }
        .tableauEquipements {
            height: 135px;
        }
        
        .alerte_mini {
           background: #d0e0ff;
        }
        .critique_mini {
            background: #d0d0ff;
        }
        .alerte_maxi {
            background: #ffe0b0;
        }
        .critique_maxi {
            background: #ffd0c0;
        }
        .thead-dark {
            background-color: #444;
            color:#fff;
        }
        .titre {
            font-size: 22px;
            background-color: #444;
            color: #fff;
        }
        .titre:hover{
            color: #444;
            background-color: #f8a06c;
        }
        .titre:focus{
            color: #444;
            background-color: #f8a06c;
        }
        .tableauAccueil {
            text-align: left;
            border-color: #fff;
            height : 500px;
        }
        .menuDeroulant {
            text-align: center;
            background-color: #e0e0e0;
            color: #444;
            font-size: 18px;
        }
        .menuDeroulant:hover{
            color: #f8a06c;
        }
    </style>

    <body>
        @include('inc.navbar')
        
        @yield('content')
        
        @include('inc.footer')
    </body>
</html>