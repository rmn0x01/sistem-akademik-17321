@extends('layouts/app')
@section('content')
    <h1> Materi Mapel {{ $data_mapel->nama_mapel }}  kelas {{ $tingkat }} </h1>
    <form action="/materi/add/process" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="mapel_id" value="{{ $data_mapel->id }}">
        <input type="hidden" name="tingkat" value="{{ $tingkat }}">
        Judul <br>
        <input type="text" name="judul"> <br>
        Deskripsi <br>
        <textarea name="deskripsi" cols="50" rows="10"></textarea> <br><br> 
        <input type="submit" value="Submit">
    </form>
@endsection