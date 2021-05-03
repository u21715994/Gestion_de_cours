@extends('model')

@section('title','Formulaire de recherche des utilisateurs par prénom')

@section('contents')
    <form method='post'>
        Prenom : <input type="text" name="prenom">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection