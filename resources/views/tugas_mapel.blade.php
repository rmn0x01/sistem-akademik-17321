@extends('layouts/app')
@section('content')
    <div class="container">
        <h2> List Tugas </h2>
        <div class="list-group">
            @foreach($list_tugas as $tugas)
                    <a href="/tugas/detail/{{$tugas->tugas_id}}" class="list-group-item">{{ $tugas->tugas_judul }}</a>
            @endforeach
        </div>
    </div>
@endsection