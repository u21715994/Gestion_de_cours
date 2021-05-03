@extends('model')

@section('title',"Formulaire de modification du mot de passe")

@section('contents')
    <form method = 'post'>
        @method('put')
            Nouveau mot de passe : <input type = "password" name = "mdp">
            <input type = "submit" value = "Envoyer">
        @csrf
    </form>
@endsection