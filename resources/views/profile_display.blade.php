@extends('layouts/app')
@section('content')
<div class="container">
@if(empty($message))
        @if($role == 'guru')
            <h2>Profil Guru</h2>
            <ul class="list-group">
                <li class="list-group-item"> Nama depan: {{$profil->nama_depan}} </li>
                <li class="list-group-item"> Nama belakang: {{$profil->nama_belakang}} </li>
                <li class="list-group-item"> Nomor Induk Pegawai: {{$profil->NIP}} </li>
                <li class="list-group-item"> Nomor HP: {{$profil->no_hp}} </li>
                <li class="list-group-item"> Tanggal lahir: {{$profil->tanggal_lahir}} </li>
        @elseif($role == 'siswa')
            <h2>Profil Siswa</h2>
            <ul class="list-group">
                <li class="list-group-item"> Nama lengkap: {{$profil->nama_lengkap}} </li>
                <li class="list-group-item"> Nomor Induk Siswa: {{$profil->NIS}} </li>
            </ul>
        @endif
@else
    <h3>{{$message}} </h3>
@endif
</div>
@endsection
