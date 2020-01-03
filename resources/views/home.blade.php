@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Homepage</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- TODO: Agenda Sekolah, Daftar Prestasi -->
                    Go to <a href="/{{$role}}"> Dashboard </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
