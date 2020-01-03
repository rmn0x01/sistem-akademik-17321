@extends('layouts/app')
@section('content')
    <div class="container">
        <h1>Penilaian Tugas</h1>
        <h4> Siswa: {{ $submisi->siswa->nama_lengkap }} </h4>
        File Tugas:  <a href="{{url('/upload_tugas_folder/'.$submisi->upload_file)}}">  {{ $submisi->upload_file }} </a> <br>
        
        @if($submisi->upload_nilai != NULL)
            <h4> Nilai: {{ $submisi->upload_nilai }} </h4>
            @if($submisi->upload_komentar != NULL)
                <h4> Komentar: {{ $submisi->upload_komentar }} </h4>
            @else
                <h4> Komentar kosong </h4>
            @endif
        @else
            <form action="/tugas/upload/nilai/{{$submisi->upload_id}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="upload_nilai"> Nilai </label>
                    <input type="number" name="upload_nilai" class="form-control">
                </div>
                <div class="form-group">
                    <label for="upload_komentar"> Komentar </label>
                    <input type="text" name="upload_komentar" class="form-control">
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
        @endif
    </div>
@endsection