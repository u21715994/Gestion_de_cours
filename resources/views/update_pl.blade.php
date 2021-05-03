@extends('model')

@section('title',"Création d'un nouveau cours pour planning")

@section('contents')
    <form method="post">
        @method('put')
        Date de début : <input type="date" name="date_d">
        Date de fin : <input type="date" name="date_f">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection