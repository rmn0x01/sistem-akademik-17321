@extends('layouts/app')
@section('content')
    <div class="container">
        <h1>List Mapel</h1>
        <a href="/mapel/create" class="badge badge-warning"> Create Mapel</a>
        <ol class="list-group">
            @foreach($list_mapel as $mapel)
                <li class="list-group-item list-group-item-action"> 
                        {{ $mapel->nama_mapel }} <br>
                        <a href="/mapel/edit/{{$mapel->id}}"> Edit</a>
                        <!-- <a href="/mapel/delete/{{$mapel->id}}"> Hapus</a> Masih ngebug -->
                </li>
            @endforeach
        </ol>
    </div>
@endsection