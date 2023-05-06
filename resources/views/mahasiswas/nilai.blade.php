@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2 text-center">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            <h1>KARTU HASIL STUDI (KHS)</h1>
        </div>
    </div>
    <ul class="list-group list-group-flush text-left mb-4" style="list-style: none;" >
        <li ><b>Nim : </b>{{$Mahasiswa->nim}}</li>
        <li ><b>Nama : </b>{{$Mahasiswa->nama}}</li>
        <li ><b>Kelas : </b>{{$Mahasiswa->kelas->nama_kelas}}</li>
    </ul>

</div>

<table class="table table-bordered">
    <tr>
        <th>Mata_Kuliah</th>
        <th>SKS</th>
        <th>Semester</th>
        <th>Nilai</th>
    </tr>
    @foreach ($Mahasiswa->mataKuliah as $matkul)
    <tr>
        <td>{{ $matkul->nama_matkul }}</td>
        <td>{{ $matkul->sks }}</td>
        <td>{{ $matkul->semester }}</td>
        <td>{{ $matkul->pivot->nilai }}</td>
    </tr>
    @endforeach
</table>
<div class="my-2" align="center">
    <a class="btn btn-primary" href="{{ route('cetak_khs',$Mahasiswa->nim) }}"> Cetak KHS </a>
</div>
@endsection

