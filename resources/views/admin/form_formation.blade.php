@extends('model')

@section('title',"Formulaire de modification d'une formation")

@section('contents')
    <form method='post'>
        @method('put')
            Intitule : <input type = "text" name = "intitule">
            <input type = "submit" value = "Envoyer">
        @csrf
    </form>
@endsection