@extends('model')

@section('title',"Création d'une nouvelle formation")

@section('contents')
    <form method="post">
        Intitule de la formation : <input type="text" name="intitule">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection
