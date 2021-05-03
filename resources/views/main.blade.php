@extends('model')

@section('title',"Page d'accueil")

@section('contents')
    <p>Bonjour sur le site</p>
    <a href="/login">Connexion</a>
    <a href="/register">Créer un nouveau compte</a>
    @if(session()->has('etat'))
        <p class="etat">{{session()->get('etat')}}</p>
    @endif
@endsection