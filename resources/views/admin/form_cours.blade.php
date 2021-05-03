@extends('model')

@section('title',"Formulaire de modification d'un cours")

@section('contents')
    <form method='post'>
        @method('put')
            Intitule : <input type = "text" name = "intitule">
            <input type = "submit" value = "Envoyer">
        @csrf
    </form>
@endsection