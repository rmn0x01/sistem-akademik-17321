@extends('layouts/app')
@section('content')

    <form action="/{{ $role }}/createprocess/profil" method='POST'> 
        {{ csrf_field() }}
        @if($role == 'siswa')
            Nama Lengkap: <input type="text" name="nama_lengkap"> <br><br>
            NIS: <input type="text" name="NIS"> <br><br>
            Kelas:
            <select name="kelas_sekarang">
                @foreach($list_kelas as $kelas)
                    <option value="{{$kelas->id}}"> {{$kelas->ruangan}} </option>
                @endforeach
            </select> <br><br>
        @elseif($role == 'guru')
            Nama Depan: <input type="text" name="nama_depan" > <br><br>
            Nama Belakang: <input type="text" name="nama_belakang"> <br><br>
            NIP: <input type="number" name="NIP"> <br><br>
            No HP: <input type="number" name="no_hp"><br><br>
            Tanggal lahir: <input type="date" name="tanggal_lahir"> <br><br>
        @endif        
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