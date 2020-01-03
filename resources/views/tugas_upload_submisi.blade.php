@extends('layouts/app')
@section('content')
    <div class="container">
        <h1>Daftar Submisi</h1>
        <div class="card">
            <div class="card-header text-white bg-success mb-3">Sudah Mengumpulkan</div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($list_submisi as $submisi)
                        <a href="/tugas/upload/siswa/{{$submisi->upload_id}}" class="list-group-item">{{$submisi->siswa->nama_lengkap}} </a>
                    @endforeach 
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-danger mb-3">Belum Mengumpulkan</div>
            <div class="card-body">
                <ol class="list-group list-group-flush">
                    @foreach($list_siswa as $siswa)
                        <li class="list-group-item">
                            {{$siswa->nama_lengkap}}
                        </li>
                    @endforeach   
                </ol>
            </div>
        </div>
    </div>
@endsection