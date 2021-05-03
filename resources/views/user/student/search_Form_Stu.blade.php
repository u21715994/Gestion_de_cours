@extends('model')

@section('title',"Recherche d'un cours")

@section('contents')
    <form method='post'>
            Intitule du cours : <input type = "text" name = "intitule">
            <input type = "submit" value = "Envoyer">
        @csrf
    </form>
@endsection