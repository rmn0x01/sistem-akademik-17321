@extends('layouts/app')
@section('content')
    <div class="container">
        <h2>Index Mapel</h2>
            <div class="list-group">
                @foreach($list_mapel as $mapel)
                    @for ($x = 10; $x < 13; $x++)
                            <a href="/materi/mapel/{{$mapel->id}}/{{$x}}" class="list-group-item">{{ $mapel->nama_mapel }} Kelas {{ $x }} </a>
                    @endfor
                    
                @endforeach
            </div>
    </div>
@endsection