@extends('layouts/app')
@section('content')
    <div class="container">
        <h1>List Kelas</h1>
        <div class="list-group">
            @foreach($list_kelas as $kelas)
                <a href="/kelas/peek/{{ $kelas->id }}" class="list-group-item list-group-item-action"> {{ $kelas->tingkat }} {{ $kelas->ruangan }} </a>
            @endforeach
        </div>
    </div>
@endsection