@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1> Kelas {{ $kelas->tingkat }} {{ $kelas->ruangan }} </h1>
            <h2> Wali kelas <a href="/guru/profil/{{$kelas->guru->user_id}}"> {{ $kelas->guru->nama_depan }} {{ $kelas->guru->nama_belakang }}</a> </h2>
            <h3> <a href="/kelas/jadwal/peek/{{$kelas->id}}"> Jadwal Pelajaran </a> </h3>
            <h5> <a href="/kelas/siswa/{{$kelas->id}}"> Daftar Siswa </a> </h5>
        </div>
    </div>

@endsection