@extends('layouts/app')
@section('content')

<div class="container" >
    <form action="/{{ $role }}/editprocess/profil" method='POST'> 
        {{ csrf_field() }}
        @if($role == 'guru')
            <div class="form-group">
                <label for="nama_depan"> Nama depan: </label>
                <input type="text" name="nama_depan" value="{{ $profil->nama_depan }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama_belakang"> Nama belakang: </label>
                <input type="text" name="nama_belakang" value="{{ $profil->nama_belakang }}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="NIP"> NIP: </label>
                <input type="number" name="NIP" value="{{ $profil->NIP }}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="tanggal_lahir"> Tanggal lahir: </label>
                <input type="date" name="tanggal_lahir" value="{{ $profil->tanggal_lahir }}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="no_hp"> No. HP: </label>
                <input type="text" name="no_hp" value="{{ $profil->no_hp }}" class="form-control" >
            </div>
        @elseif($role == 'siswa')
            <div class="form-group">
                <label for="nama_lengkap"> Nama lengkap: </label>
                <input type="text" name="nama_lengkap" value="{{ $profil->nama_lengkap }}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="NIS"> NIS: </label>
                <input type="number" name="NIS" value="{{ $profil->NIS }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="kelas_sekarang"> Kelas: </label>
                <select name="kelas_sekarang" class="form-control">
                    @foreach($list_kelas as $kelas)
                        @if($profil->kelas_sekarang == $kelas->id)
                        <option value="{{$kelas->id}}" selected="selected"> {{$kelas->tingkat}} {{$kelas->ruangan}} </option>
                        @else
                        <option value="{{$kelas->id}}"> {{$kelas->tingkat}} {{$kelas->ruangan}} </option>
                        @endif
                    @endforeach
                </select>    
            </div>
        @endif
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