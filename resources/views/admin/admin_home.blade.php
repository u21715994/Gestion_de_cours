@extends('model')

@section('title',"Page d'accueil Admin")

@section('contents')
    <p>Voici vos actions possibles : </p>
    <ul>
        <li><a href="/admin/user">Liste des utilisateurs</a></li>
        <li><a href="/admin/user/type">Liste des utilisateur par type</a></li>
        <li><a href="/admin/user/search/nom">Recherche des utilisateurs par nom</a></li>
        <li><a href="/admin/user/search/prenom">Recherche des utilisateurs par prenom</a></li>
        <li><a href="/admin/user/search/login">Recherche des utilisateurs par login</a></li>
        <li><a href="/admin/user/create">Création d'un utilisateur</a></li>
        <li><a href="/admin/cours">Liste des Cours</a></li>
        <li><a href="/admin/cours/create">Création d'un cours</a></li>
        <li><a href="/admin/cours/search">Recherche d'un cours</a></li>
        <li><a href="/admin/formation">Liste des Formation</a></li>
        <li><a href="/admin/formation/create">Création d'une formation</a></li>
    </ul>
    <li><a href="/logout">Déconnexion</a></li>
@endsection
