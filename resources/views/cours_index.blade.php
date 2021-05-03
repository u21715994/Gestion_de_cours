@extends('model')

@section('title',"Liste des cours")

@section('contents')
    @if(Auth::user()->type == "admin")
        <table class= "table table-bordered">
            <tr><th>ID de l'enseignant</th><th>ID de la formation</th><th>Intitule</th><th>Date de création</th><th>Date de modifiction</th><th>Suppression</th><th>Modification</th><th>Associer à un enseignant</th><th>Plannings</th><th>Créer planning</th></tr>
            @foreach($cours as $c)
                <tr><td>{{$c->user_id}}</td><td>{{$c->formation_id}}</td><td>{{$c->intitule}}</td><td>{{$c->created_at}}</td><td>{{$c->updated_at}}</td><td><a href="/admin/{{$c->id}}/cours/delete">Supprimer</a></td><td><a href="/admin/{{$c->id}}/cours/update">Modifier</a></td><td><a href="/admin/{{$c->id}}/teacher/cours">Associer enseignant</a></td><td><a href="/admin/{{$c->id}}/cours/plannings">Plannings du cours</a></td><td><a href="/admin/{{$c->id}}/planning/create">Création Planning Cours</a></td></tr>
            @endforeach
        </table>
        <a href="/admin">Retour</a>
        @if(session()->has('etat'))
            <p class="etat">{{session()->get('etat')}}</p>
        @endif
    @elseif(Auth::user()->type == "enseignant")
        <table class= "table table-bordered">
           <tr><th>ID de l'enseignant</th><th>ID de la formation</th><th>Intitule</th><th>Planning cours Responsable</th><th>Création d'une nouvelle séance de cours</th></tr>
            @foreach($cours as $c)
                <tr><td>{{$c->user_id}}</td><td>{{$c->formation_id}}</td><td>{{$c->intitule}}</td><td><a href="/teacher/{{$c->id}}/planning/cours">Plannings du cours</a></td><td><a href="/teacher/{{$c->id}}/planning/create">Création d'une séance</a></td></tr>
            @endforeach
        </table>
        <a href="/teacher">Retour</a>
    @else
        <table class= "table table-bordered">
            <tr><th>ID de l'enseignant</th><th>ID de la formation</th><th>Intitule</th><th>Inscription</th><th>Déinscription</th><th>Planning cours Inscrit</th></tr>
            @foreach($cours as $c)
                <tr><td>{{$c->user_id}}</td><td>{{$c->formation_id}}</td><td>{{$c->intitule}}</td><td><a href="/student/{{$c->id}}/inscription">Inscription</a></td><td><a href="/student/{{$c->id}}/deinscription">Déinscription</a></td><td><a href="/student/{{$c->id}}/planning/cours">Plannings du cours</a></td></tr>
            @endforeach
        </table>
        <a href="/student">Retour</a>
        @if(session()->has('etat'))
            <p class="etat">{{session()->get('etat')}}</p>
        @endif
    @endif
@endsection