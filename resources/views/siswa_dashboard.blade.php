@extends('layouts/app')
@section('content')
<div class='container' >
    <div class='jumbotron'>
    <h1>Dashboard Siswa</h1>
    @if(isset($kelas)) 
        <h2>Kelas <a href="/kelas">{{ $kelas }}</a></h2>
    @endif
    <a href="/{{ $role }}/profil/{{$user_id}}">Profil</a>
    <a href="/{{ $role }}/edit/profil">Edit Profil</a> <br>    
    </div>
</div>

@endsection