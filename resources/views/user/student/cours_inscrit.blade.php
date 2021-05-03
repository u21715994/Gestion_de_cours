@extends('model')

@section('title',"Liste des cours dans lesquels l'étudiant est inscrit")

@section('contents')
    <table class= "table table-bordered">
        <tr><th>ID du cours</th><th>ID de l'étudiant</th><th>Détail</th></tr>
        @foreach($cours_users as $c_u)
            <tr><td>{{$c_u->cours_id}}</td><td>{{$c_u->user_id}}</td><td><a href="/student/{{$c_u->cours_id}}/cours/inscrit">Détail du cours</a></td></tr>
        @endforeach
    </table>
    <a href="/student">Retour</a>
@endsection