@extends('layouts/app')
@section('content')
<!-- Masih ngebug bagian delete -->
    <div class="container">
        <h1>List Mapel - Kelas - Guru</h1>
        <a href="/mapelassoc/create" class="badge badge-warning"> Add new association </a>
        <ol class="list-group">
            @foreach($list_mapel_assoc as $mapel_assoc)
                <li class="list-group-item list-group-item-action"> 
                    {{ $mapel_assoc->mapel->nama_mapel }} ---
                    {{ $mapel_assoc->kelas->tingkat }} {{ $mapel_assoc->kelas->ruangan }} ---
                    {{ $mapel_assoc->guru->nama_depan }} {{ $mapel_assoc->guru->nama_belakang }} <br>
                    <a href="/mapelassoc/edit/{{ $mapel_assoc->id }}"> Edit </a> ---
                    <a href="/mapelassoc/delete/{{ $mapel_assoc->id }}"> Delete </a> ---
                    <a href="/jadwal/detail/{{ $mapel_assoc->id }}"> Jadwal </a>
                </li>
            @endforeach
        </ol>
    </div>
@endsection