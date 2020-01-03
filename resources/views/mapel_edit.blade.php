@extends('layouts/app')
@section('content')
    <!-- <form action="/mapel/process/edit" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $mapel->id }}">
        Nama Mata Pelajaran: <input type="text" name="nama_mapel" value="{{ $mapel->nama_mapel }}"> <br><br>
        Deskripsi: <input type="textarea" name="deskripsi" value="{{ $mapel->deskripsi }}"> <br><br>
        <input type="submit" value="Submit">
    </form> -->
    <div class="container">
        <form action="/mapel/process/edit" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $mapel->id }}">
                <div class="form-group">
                    <label for="nama_mapel">Nama Mata Pelajaran: </label>
                    <input type="text" name="nama_mapel" value="{{ $mapel->nama_mapel }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi: </label>
                    <input type="textarea" name="deskripsi" value="{{ $mapel->deskripsi }}"class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
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