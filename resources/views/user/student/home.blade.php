@extends('model')

@section('title',"Page d'accueil de l'étudiant")

@section('contents')
    <p>Bonjour {{Auth::user()->type}} {{Auth::user()->login}}</p>
    <ul>
        <li><a href="/student/cours">Liste des cours de la formation</a></li>
        <li><a href="/student/cours/inscrit">Liste des cours dans lesquel l'étudiant est inscrit</a></li>
        <li><a href="/student/cours/search">Recherche d'un cours dans la liste des cours de la formation</a></li>
        <li><a href="/student/planning">Liste de planning dans lesquel on est inscrit</a></li>
        <li><a href="/student/update">Modification du nom et prénom</a></li>
        <li><a href="/student/pwd">Modification du mot de passe</a></li>
    </ul>
    <a href="/logout">Déconnexion</a>
@endsection

