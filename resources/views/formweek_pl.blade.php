@extends('model')

@section('title','Semaine planning')

@section('contents')
    <form method='post'>
        Semaine à choisir : <input type="date" name="planning_week">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection