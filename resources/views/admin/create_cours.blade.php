@extends('model')

@section('title',"Création d'un nouveau cours")

@section('contents')
    <form method="post">
        Intitule de la formation : <select name="intitule_f">
            @foreach($formation as $f)
                <option value="{{$f->intitule}}">{{$f->intitule}}</option>
            @endforeach
        </select>
        Intitule du cours : <input type="text" name="intitule">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection