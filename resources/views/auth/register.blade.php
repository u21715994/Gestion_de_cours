@extends('model')

@section('contents')
    <p>Enregistrement</p>
    <form method="post">
        Nom : <input type="text" name="nom">
        Prenom : <input type="text" name="prenom">
        Login: <input type="text" name="login" value="{{old('login')}}">
        MDP: <input type="password" name="mdp">
        Confirmation MDP: : <input type="password" name="mdp_confirmation">
        Type : <select name="type">
            <option value="enseignant">Enseignant</option>
            <option value="etudiant">Etudiant</option>
        </select>
        Formation : <select name="formation_id">
            <option value="0">null</option>
            @foreach($formation as $f)
                <option value="{{$f->id}}">{{$f->intitule}}</option>
            @endforeach
        </select>
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection
