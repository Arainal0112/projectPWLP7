@extends('mahasiswas.layout')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Tambah Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your i
                    nput.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswas.store') }}" id="myForm">
                    @csrf
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="nim" class="form-control" id="nim" aria-describedby="nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="Nama" name="nama" class="form-control" id="nama" aria-describedby="nama">
                    </div>
                    <div class="form-group">
                        <label for="ttl">Tanggal Lahir</label>
                        <input type="date" name="ttl" class="form-control" id="ttl" aria-describedby="TTL" value='2000-01-01'>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="kelas" name="kelas" class="form-control" id="kelas" aria-describedby="password">
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="jurusan" name="jurusan" class="form-control" id="jurusan" aria-describedby="jurusan">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="Email">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Handphone</label>

                        <input type="no_hp" name="no_hp" class="form-control" id="no_hp" aria-describedby="no_hp">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
