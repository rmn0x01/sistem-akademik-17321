@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"> <b>{{ $materi->judul }}</h1> </b> 
                <p class="card-text"> {{ $materi->deskripsi }} </p>
                @if($admin)
                    <a href="/materi/edit/{{ $materi->id }}" class="card-link"> Edit </a> 
                    <a href="/materi/delete/{{ $materi->id }}" class="card-link"> Delete </a>
                @endif
            </div>
        </div>
    </div>
@endsection