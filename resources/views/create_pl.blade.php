@extends('model')

@section('title',"Création d'une nouvelle scéance de cours")

@section('contents')
    <form method="post">
        Date de début : <input type="date" name="date_d">
        Date de fin : <input type="date" name="date_f">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection