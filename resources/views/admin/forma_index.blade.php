@extends('model')

@section('title',"Liste des formations")

@section('contents')
    <table class= "table table-bordered">
    <tr><th>Intitule</th><th>Date de création</th><th>Date de modifiction</th><th>Suppression</th><th>Modification</th></tr>
        @foreach($formation as $f)
            <tr><td>{{$f->intitule}}</td><td>{{$f->created_at}}</td><td>{{$f->updated_at}}</td><td><a href="/admin/{{$f->id}}/formation/delete">Supprimer</a></td><td><a href="/admin/{{$f->id}}/formation/update">Modifier</a></td></tr>
        @endforeach
    </table>
    @if(session()->has('etat'))
        <p class="etat">{{session()->get('etat')}}</p>
    @endif
    <a href="/admin">Retour</a>
@endsection