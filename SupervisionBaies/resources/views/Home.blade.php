@extends('Layouts.Layout')

@section('content')

<div class="container-fluid">
    <hr style="color: #222222">
    <h1 class="mt-4">Accueil</h1>
    <hr style="color: #222222">   
</div> 

<div id="the_div" class="container-fluid bg-1 text-center">
    <div id="Layer1" style="position:absolute; z-index:1">
        <img src="IMAGES/PlanLMSvert.png" alt="PlanLMS" style="width: 80%"/>
    </div> 
    @foreach($Home as $HomeEtat)
    @if($HomeEtat->id_baie == 1)
    @if($HomeEtat->etat_baie == 1)
    <div id="Layer1" style="position:absolute; z-index:80">
        <img src="IMAGES/PlanLMS_batB_rouge.png" alt="PlanLMS" style="width: 80%;"/>
    </div>
    @endif
    @endif

    @if($HomeEtat->id_baie == 2)
    @if($HomeEtat->etat_baie == 1)
    <div id="Layer1" style="position:absolute; z-index:100">
        <img src="IMAGES/PlanLMS_batC_rouge.png" alt="PlanLMS" style="width: 80%;"/>
    </div>
    @endif
    @endif

    @if($HomeEtat->id_baie == 3)
    @if($HomeEtat->etat_baie == 1)
    <div id="Layer1" style="position:absolute; z-index:70">
        <img src="IMAGES/PlanLMS_batD_rouge.png" alt="PlanLMS" style="width: 80%;"/>
    </div>
    @endif
    @endif

    @if($HomeEtat->id_baie == 4)
    @if($HomeEtat->etat_baie == 1)
    <div id="Layer1" style="position:absolute; z-index:50">
        <img src="IMAGES/PlanLMS_batF_rouge.png" alt="PlanLMS" style="width: 80%;"/>
    </div>
    @endif
    @endif

    @if($HomeEtat->id_baie == 5)
    @if($HomeEtat->etat_baie == 1)
    <div id="Layer1" style="position:absolute; z-index:60">
        <img src="IMAGES/PlanLMS_batG_rouge.png" alt="PlanLMS" style="width: 80%;"/>
    </div>
    @endif
    @endif
    @endforeach    
</div>
@endsection