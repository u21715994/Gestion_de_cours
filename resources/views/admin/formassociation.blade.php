@extends('model')

@section('title',"Formulaire d'association d'un enseignant à un cours")

@section('contents')
    <form method="post">
        Intitule du cours : <select name="intitule">
            @foreach($cours as $c)
                <option value="{{$c->intitule}}">{{$c->intitule}}</option>
            @endforeach
        </select>
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection