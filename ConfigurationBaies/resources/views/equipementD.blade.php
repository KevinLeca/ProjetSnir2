@extends('layout.layout')

@section('content')
<hr style="color: #222222">
    <h1>Seuils des équipements de la baie D</h1>
    <hr style="color: #222222">
    
   <!--formulaire de configuration-->
    <div class="col-md-6 col-lg-6">
        @include('inc.configSeuilsEquipements')
    </div>
    
    <!--affichage des seuils actuels-->
    <div class="col-md-6 col-lg-6">
        @include('inc.tabSeuilsEquipements')
    </div>
@endsection