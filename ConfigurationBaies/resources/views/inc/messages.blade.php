<!--affichage des messages d'erreur-->
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{$error}}
        </div>
    @endforeach
@endif