@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div class="float-left my-2">
            <form action="{{ route('mahasiswas.index') }}" method="GET" class="d-flex">
                <input type="text" class="form-control" name="nama" placeholder="Nama Mahasiswa" value="{{request('nama')}}" required>
                <button type="submit" class="btn btn-outline-primary">Search</button>

            </form>

        </div>
        <div class="float-right my-2">
            <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>

        <th>Nim</th>
        <th>Nama</th>
        <th>Foto</th>
        <th>Tanggal lahir</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>E-mail</th>
        <th>No Handphone</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($mahasiswas as $Mahasiswa)
    <tr>
        <td>{{ $Mahasiswa->nim }}</td>
        <td>{{ $Mahasiswa->nama }}</td>
        <td><img width="100px" src="{{asset('storage/'.$Mahasiswa->foto)}}"></td>
        <td>{{ $Mahasiswa->tgl_lahir }}</td>
        <td>{{ $Mahasiswa->kelas->nama_kelas }}</td>
        <td>{{ $Mahasiswa->jurusan }}</td>
        <td>{{ $Mahasiswa->email }}</td>
        <td>{{ $Mahasiswa->no_hp }}</td>
        <td>
            <form action="{{ route('mahasiswas.destroy',$Mahasiswa->nim) }}" method="POST">
                <a class="btn btn-info" href="{{ route('mahasiswas.show',$Mahasiswa->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$Mahasiswa->nim) }}">Edit</a>
                
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning" href="mahasiswas/nilai/{{$Mahasiswa->nim }}">Nilai</a>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex">
    {{ $mahasiswas->links() }}
</div>
@endsection

