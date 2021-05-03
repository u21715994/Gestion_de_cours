@extends('model')

@section('title',"Planning")

@section('contents')
    @if(Auth::user()->type == 'enseignant')
        <table class= "table table-bordered">
        <tr><th>ID du Cours</th><th>Date de début</th><th>Date de fin</th><th>Suppression</th><th>Modification</th><th>Détail du cours</th></tr>
            @foreach($planning as $p)
                <tr><td>{{$p->cours_id}}</td><td>{{$p->date_debut}}</td><td>{{$p->date_fin}}</td><td><a href="/teacher/{{$p->id}}/planning/delete">Supprimer</a></td><td><a href="/teacher/{{$p->id}}/planning/update">Modifier</a></td><td><a href="/teacher/{{$p->cours_id}}/detail">Détail du cours</a></td></tr>
            @endforeach
        </table>
        <a href="/teacher">Retour</a>
    @elseif(Auth::user()->type == 'admin')
    <table class= "table table-bordered">
        <tr><th>ID du Cours</th><th>Date de début</th><th>Date de fin</th><th>Suppression</th><th>Modification</th><th>Détail du cours</th></tr>
            @foreach($planning as $p)
                <tr><td>{{$p->cours_id}}</td><td>{{$p->date_debut}}</td><td>{{$p->date_fin}}</td><td><a href="/admin/{{$p->id}}/planning/delete">Supprimer</a></td><td><a href="/admin/{{$p->id}}/planning/update">Modifier</a></td><td><a href="/admin/{{$p->cours_id}}/detail">Détail du cours</a></td></tr>
            @endforeach
        </table>
        <a href="/admin">Retour</a>
    @else
    <table class= "table table-bordered">
        <tr><th>ID du Cours</th><th>Date de début</th><th>Date de fin</th><th>Détail du cours</th></tr>
            @foreach($planning as $p)
                <tr><td>{{$p->cours_id}}</td><td>{{$p->date_debut}}</td><td>{{$p->date_fin}}</td><td><a href="/student/{{$p->cours_id}}/detail">Détail du cours</a></td></tr>
            @endforeach
        </table>
    <a href="/student">Retour</a>
    @endif
    @if(session()->has('etat'))
        <p class="etat">{{session()->get('etat')}}</p>
    @endif
@endsection