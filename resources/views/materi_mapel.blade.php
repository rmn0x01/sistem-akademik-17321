@extends('layouts/app')
@section('content')
    <div class="container">
        <h1> Materi {{ $data_mapel->nama_mapel }}  kelas {{ $tingkat }} </h1>
        @if($admin)
            <a href="/materi/add/{{ $data_mapel->id }}/{{ $tingkat }}"> Tambah materi </a>
        @endif
        @if(!$list_materi->isEmpty())
            <div class="list-group">
                @foreach($list_materi as $materi)
                        <a href="/materi/detail/{{ $materi->id }}" class="list-group-item"> {{ $materi->judul }} </a> <br>
                @endforeach
            </div>    
        @endif
    </div>
@endsection