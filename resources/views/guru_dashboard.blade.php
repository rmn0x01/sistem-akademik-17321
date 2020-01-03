@extends('layouts/app')
@section('content')
<div class='container' >
    <div class='jumbotron'>
        <h1>Dashboard Guru</h1> 
        <a href="/{{ $role }}/profil/{{$user_id}}">Profil</a>
        <a href="/{{ $role }}/edit/profil">Edit Profil</a> <br>
        <a href="/guru/jadwal"> Jadwal Pelajaran </a> <br>
        <a href="/kelas/full"> List Kelas </a> <br>
        <a href="/guru/mapel"> Manage Tugas </a>
    </div>
</div>
@endsection