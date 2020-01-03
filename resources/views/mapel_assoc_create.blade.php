@extends('layouts/app')
@section('content')
    <h1>Create Mapel Assoc</h1>
    <form action="/mapelassoc/create/process" method="post">
        {{ csrf_field() }}
        <select name="mapel_id">
            @foreach($list_mapel as $mapel)
                <option value="{{$mapel->id}}"> {{ $mapel->nama_mapel }} </option>
            @endforeach
        </select>
        <select name="kelas_id">
            @foreach($list_kelas as $kelas)
                <option value="{{$kelas->id}}"> {{ $kelas->tingkat }} {{ $kelas->ruangan }}  </option>
            @endforeach
        </select>
        <select name="pengampu_id">
            @foreach($list_guru as $guru)
                <option value="{{$guru->id}}"> {{ $guru->nama_depan }} {{ $guru->nama_belakang }} </option>
            @endforeach
        </select>
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