@extends('layouts/app')
@section('content')
    <div class="container">
        <form action="/mapel/create/process" method="POST">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama_mapel">Nama Mata Pelajaran: </label>
                    <input type="text" name="nama_mapel" class="form-control">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi: </label>
                    <input type="textarea" name="deskripsi" class="form-control">
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