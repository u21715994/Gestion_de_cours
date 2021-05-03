@extends('model')

@section('title',"Liste des utilisateurs")

@section('contents')
    <table class= "table table-bordered">
        <tr><th>ID</th><th>Nom</th><th>Prenom</th><th>Login</th><th>Type</th><th>Formation</th><th>Acceptation</th><th>Suppression/Refus</th><th>Modification</th><th>Association à un cours</th><th>Cours responsable</th><th>Gestion des plannings</th></tr>
        @foreach($user as $u)
            @if($u->type == 'enseignant')
                <tr><td>{{$u->id}}</td><td>{{$u->nom}}</td><td>{{$u->prenom}}</td><td>{{$u->login}}</td><td>{{$u->type}}</td><td>{{$u->formation_id}}</td><td><a href="/admin/{{$u->id}}/user/validated">Acceptation</a></td><td><a href="/admin/{{$u->id}}/user/delete">Supprimer/Refus</a></td><td><a href="/admin/{{$u->id}}/user/update">Modifier</a></td><td><a href="/admin/{{$u->id}}/user/association">Associer à un cours</a></td><td><a href="/admin/{{$u->id}}/cours/teacher">Cours dont il est responsable</a></td><td><a href="/admin/{{$u->id}}/plannings">Gestion plannings</a></td></tr>
            @else
            <tr><td>{{$u->id}}</td><td>{{$u->nom}}</td><td>{{$u->prenom}}</td><td>{{$u->login}}</td><td>{{$u->type}}</td><td>{{$u->formation_id}}</td><td><a href="/admin/{{$u->id}}/user/validated">Acceptation</a></td><td><a href="/admin/{{$u->id}}/user/delete">Supprimer/Refus</a></td><td><a href="/admin/{{$u->id}}/user/update">Modifier</a></td></tr>
            @endif
        @endforeach
    </table>
    @if(session()->has('etat'))
            <p class="etat">{{session()->get('etat')}}</p>
    @endif
    <a href="/admin">Retour</a>
@endsection