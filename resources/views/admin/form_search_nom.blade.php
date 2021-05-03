@extends('model')

@section('title','Formulaire de recherche des utilisateurs par nom')

@section('contents')
    <form method='post'>
        Nom : <input type="text" name="nom">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection