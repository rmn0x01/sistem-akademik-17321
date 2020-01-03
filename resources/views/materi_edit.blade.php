@extends('layouts/app')
@section('content')
    <h2> Edit Materi </h2>
    <form action="/materi/edit/process" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $materi->id }}">
        Judul <br>
        <input type="text" name="judul" value="{{ $materi->judul }}"> <br>
        Deskripsi <br>
        <textarea name="deskripsi" cols="50" rows="10"> {{ $materi->deskripsi }} </textarea> <br><br> 
        <input type="submit" value="Submit">
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
@endsection