@extends('layouts/app')
@section('content')
    <div class="container">
        <h1>Edit Tugas</h1>
        <h2> 
            {{ $tugas->mapelassociation->mapel->nama_mapel }}
            {{ $tugas->mapelassociation->kelas->tingkat }}
            {{ $tugas->mapelassociation->kelas->ruangan }}
        </h2>

        <form action="/tugas/edit/process/{{$tugas->tugas_id}}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="tugas_judul">Judul Tugas </label>
                <input type="text" name="tugas_judul" value="{{ $tugas->tugas_judul }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="tugas_deskripsi"> Deskripsi Tugas </label>
                <textarea name="tugas_deskripsi" cols="30" rows="10" class="form-control"> {{ $tugas->tugas_deskripsi }} </textarea>
            </div>
            <div class="form-group">
                <label for="tugas_deadline"> Deadline  </label>
                <input type="datetime-local" name="tugas_deadline" placeholder="YYYY-MM-DD HH:MM:SS" value="{{ $tugas->tugas_deadline }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection