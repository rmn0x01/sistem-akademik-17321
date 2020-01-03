@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-white bg-info mb-3">
                <h4> <b> Deskripsi tugas</b> </h4>
            </div>
            <div class="card-body">
                <p> <b>{{ $tugas->tugas_judul }} </b> </p>
                <p> Deskripsi tugas: <br> {{ $tugas->tugas_deskripsi }} </p>
                <p> Deadline tugas: <br> {{ $tugas->tugas_deadline }}  </p>
            </div>
        </div>
        @if($is_siswa)
            <div class="card">
                <div class="card-header text-white bg-secondary mb-3">
                    <h4> <b> Status File Tugas </b> </h4>
                </div>
                <div class="card-body">
                    @if($tugas_upload!=NULL)

                        File tugas yang telah anda unggah: <br>
                        <a href="{{url('/upload_tugas_folder/'.$tugas_upload->upload_file)}}"> {{ $tugas_upload->upload_file }} </a>
                        @if($tugas_upload->upload_nilai==NULL)
                            <h5>Perbarui(pdf max 10 MB)</h5>
                            @if($past_deadline)
                                <h5>Submisi telah ditutup</h5>
                            @else
                                <form action="/tugas/upload/update/{{ $tugas->tugas_id }}" method="post"  enctype="multipart/form-data"> 
                                    {{ csrf_field() }}
                                    <input type="file" name="upload_file">  
                                    <input type="submit" value="Unggah">
                                </form>
                            @endif
                </div>
            </div>
                    @else
                    </div>
            </div>
                    <div class="card">
                        <div class="card-header text-white bg-success mb-3">
                            <h4> <b> Penilaian </b> </h4>
                        </div>
                        <div class="card-body">
                            <p> Nilai anda: {{ $tugas_upload->upload_nilai }} </p>
                            <p> Komentar: </p>
                            <p> {{ $tugas_upload->upload_komentar }} -</p> 
                    @endif
                        </div>
                    </div>
                        
                @else   
                        <!-- <div class="card">
                            <div class="card-header text-white bg-secondary mb-3">
                                <h4> <b> Status File Tugas </b> </h4>
                            </div>
                            <div class="card-body"> -->
                    @if($past_deadline)
                                <h5>Submisi telah ditutup</h5>
                    @else
                                <h5>Unggah Tugas(pdf max 10 MB)</h5>
                                <form action="/tugas/upload/{{ $tugas->tugas_id }}" method="post"  enctype="multipart/form-data" > 
                                    {{ csrf_field() }}
                                    <input type="file" name="upload_file">  
                                    <input type="submit" value="Unggah">
                                </form>
                            </div>
                        </div>
                    @endif 
                @endif

        @else 
        <div class="card">
            <div class="card-header text-white bg-dark mb-3" > <h4> <b> Manage Tugas </b> </h4></div>
            <div class="card-body">
            <a href="/tugas/edit/{{$tugas->tugas_id}}" class="card-link"> Edit </a> <br>
            <a href="/tugas/delete/{{$tugas->tugas_id}}" class="card-link"> Delete </a> <br>
            <a href="/tugas/upload/submisi/{{$tugas->tugas_id}}" class="card-link"> Submisi </a>               
            </div>
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br/>
            @endforeach
        </div>
        @endif
    </div>
@endsection