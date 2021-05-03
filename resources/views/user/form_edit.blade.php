@extends('model')

@section('title',"Formulaire de modification du nom et prénom")

@section('contents')
    <form method='post'>
        @method('put')
            Nom : <input type = "text" name = "nom">
            Prenom : <input type = "text" name = "prenom">
            <input type = "submit" value = "Envoyer">
        @csrf
    </form>
@endsection