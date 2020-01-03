@extends('layouts/app')
@section('content')
    <div class="container">
        <h3> Tugas Kelas </h3>
        <ol class="list-group">
            @foreach($list_mapel as $mapel)
                <li class="list-group-item">
                    <h3> <a href="/tugas/mapel/{{$mapel->mapel_assoc_id}}">{{ $mapel->mapelassociation->mapel->nama_mapel }}</a>  </h3>
                </li>
            @endforeach
        </ol>
    </div>
@endsection