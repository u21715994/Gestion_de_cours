@extends('model')

@section('title',"Gestion des plannings pour l'administrateur")

@section('contents')
    <p>Voici vos actions possibles : </p>
    <ul>
        <li><a href="/admin/{{$id}}/cours/teacher">Liste des cours dont cet enseignant est responsable</a></li>
        <li><a href="/admin/{{$id}}/cours/planning/teacher">Liste de planning dont cet enseignant est responsable</a></li>
    </ul>
    <a href="/admin">Retour</a>
    <a href="/logout">Déconnexion</a>
@endsection