@extends('model')

@section('title',"Association d'un cours à un enseignant")

@section('contents')
    <form method='post'>
        Login des enseignants : <select name="id">
            @foreach($user as $u)
                @if($u->type == 'enseignant')
                    <option value="{{$u->id}}">{{$u->login}}</option>
                @endif
            @endforeach
        </select>
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection