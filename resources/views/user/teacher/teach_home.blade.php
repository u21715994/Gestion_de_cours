@extends('model')

@section('title',"Page d'accueil de l'enseignant")

@section('contents')
    <p>Bonjour {{Auth::user()->type}} {{Auth::user()->login}}</p>
    <ul>
        <li><a href="/teacher/cours">Liste des cours dont on est responsable</a></li>
        <li><a href="/teacher/planning">Liste de planning dont on est responsable</a></li>
        <li><a href="/teacher/update">Modification du nom et prénom</a></li>
        <li><a href="/teacher/pwd">Modification du mot de passe</a></li>
    </ul>
    <a href="/logout">Déconnexion</a>
@endsection