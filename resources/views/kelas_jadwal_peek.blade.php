@extends('layouts/app')
@section('content')
    <div class="container">
        <h1> Jadwal Pelajaran {{ $nama_kelas }} </h1>
        <ol class="list-group">
            @foreach($list_jadwal as $jadwal)
                <li class="list-group-item">
                    {{ $jadwal->mapelassociation->mapel->nama_mapel }} <br>
                    {{ $jadwal->hari }} -
                    {{ $jadwal->jam_mulai }} - 
                    {{ $jadwal->jam_selesai }} <br>
                </li>
            @endforeach        
        </ol>
    </div>
@endsection