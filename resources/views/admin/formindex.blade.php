@extends('model')

@section('title',"Formulaire d'affichage des utilisateurs par type")

@section('contents')
    <form method='post'>
        Sélectionner le type de l'utilisateur : <select name="type">
            <option value="enseignant">Enseignant</option>
            <option value="etudiant">Etudiant</option>
        </select>
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection