@extends('layouts/app')
@section('content')
    <div class="container">
        <h1> Tambah tugas </h1>
        <form action="/tugas/add/process" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="mapel_assoc_id"> Mapel </label>
                <select name="mapel_assoc_id" class="form-control">
                    @foreach($list_mapel as $mapel)
                        <option value="{{ $mapel->id }}"> {{$mapel->mapel->nama_mapel}} - {{$mapel->kelas->tingkat}} - {{$mapel->kelas->ruangan}} </option>
                    @endforeach        
                </select>    
            </div>
            <div class="form-group">
                <label for="tugas_judul">Judul Tugas </label>
                <input type="text" name="tugas_judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="tugas_deskripsi"> Deskripsi Tugas </label>
                <textarea name="tugas_deskripsi" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="tugas_deadline"> Deadline  </label>
                <input type="datetime-local" name="tugas_deadline" placeholder="YYYY-MM-DD HH:MM:SS" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection