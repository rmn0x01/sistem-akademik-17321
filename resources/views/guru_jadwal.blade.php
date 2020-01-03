@extends('layouts/app')
@section('content')
    <div class="container">
        @if($list_jadwal == NULL)
            <h3>Belum ada Jadwal</h3>
        @else
            <h2> Jadwal Pelajaran </h2>
            <ol class="list-group">
                @foreach($list_jadwal as $jadwal)
                    <li class="list-group-item list-group-item-action">
                        {{ $jadwal->mapelassociation->mapel->nama_mapel }} <br>
                        {{ $jadwal->mapelassociation->kelas->tingkat }} {{ $jadwal->mapelassociation->kelas->ruangan }} <br>
                        {{ $jadwal->hari }} -
                        {{ $jadwal->jam_mulai }} - 
                        {{ $jadwal->jam_selesai }} <br>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
@endsection