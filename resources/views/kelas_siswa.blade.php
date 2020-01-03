@extends('layouts/app')
@section('content')
    <div class="container">
        <h2> Daftar Siswa </h2>
            <div class="list-group">
                @foreach($list_siswa as $siswa)
                        <a href="/siswa/profil/{{$siswa->user_id}}" class="list-group-item"> {{$siswa->nama_lengkap}} </a>
                @endforeach
            </div>
    </div>
@endsection