@extends('model')

@section('title','Formulaire de recherche des utilisateurs par login')

@section('contents')
    <form method='post'>
        Login : <input type="text" name="login">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection