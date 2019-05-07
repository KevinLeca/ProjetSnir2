@extends('layout.layout')

@section('content')
<hr style="color: #222222">
    <h1>Seuils de la baie C</h1>
    <hr style="color: #222222">
    
    <!--formulaire de configuration-->
    <div class="col-md-6 col-lg-6">
        @include('inc.configSeuilsBaies')
    </div>
    
    <!--affichage des seuils actuels-->
    <div class="col-md-6 col-lg-6">
        @include('inc.tabSeuilsBaies')
    </div>
@endsection