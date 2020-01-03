@extends('layouts/app')
@section('content')
    <div class="container">
        <h2> {{ $mapel_assoc->mapel->nama_mapel }}  {{ $mapel_assoc->kelas->nama_kelas }} </h2>
        <ul class="list-group">
            @foreach($list_jadwal as $jadwal)
            <li class="list-group-item list-group-item-action"> 
                {{$jadwal->hari}} <br>
                {{$jadwal->jam_mulai}} -
                {{$jadwal->jam_selesai}} <br>
                <a href="/jadwal/delete/{{$jadwal->id}}"> Delete </a>
            </li>
            @endforeach
        </ul>
        <br>
        <h4>Tambah jadwal</h4>
        <form action="/jadwal/add/process" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="mapel_assoc_id" value="{{ $mapel_assoc->id }}"> 
            <div class="form-group">
                <label for="hari">Hari: </label>
                    <select name="hari" class="form-control">
                    <option value="Senin"> Senin </option>
                    <option value="Selasa"> Selasa </option>
                    <option value="Rabu"> Rabu </option>
                    <option value="Kamis"> Kamis </option>
                    <option value="Jumat"> Jumat </option>
                    <option value="Sabtu"> Sabtu </option>
                </select> 
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai: </label>
                <input type="time" name="jam_mulai" class="form-control">
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai: </label>
                <input type="time" name="jam_selesai" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
    </div>
@endsection