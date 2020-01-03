@extends('layouts/app')
@section('content')
    <div class="container">
        <h1> Manage Tugas </h1>
        <h2> Mata Pelajaran </h2>
        <a href="/tugas/add" class="badge badge-warning"> Tambah Tugas </a>
        <div class="list-group">
            @foreach($list_mapel as $mapel)
                    <a href="/tugas/mapel/{{$mapel->id}}" class="list-group-item">{{ $mapel->mapel->nama_mapel }} <br> {{ $mapel->kelas->tingkat }} - {{ $mapel->kelas->ruangan }} </a>
            @endforeach
        </div>
    </div>
@endsection