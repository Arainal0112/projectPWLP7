<!DOCTYPE html>
<html>

<head>
    <title>Kartu Hasil Studi</title>
</head>
<style>
    h1,h2{
        text-align:center;
    }
    table {
        width: 100%;
        border: 1px solid;
    }
    th, td {
        padding: 15px;
        text-align: center;
        border: 1px solid;
    }
    .text-left{
        text-align:left;
    }
</style>

<body>
    
        <h1>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h1>
        <h2>KARTU HASIL STUDI (KHS)</h2>
    
    <p><b>Nama: </b>{{$Mahasiswa->nama}}</p>
    <p><b>Nim: </b>{{$Mahasiswa->nim}}</p>
    <p><b>Kelas: </b>{{$Mahasiswa->kelas->nama_kelas}}</p>


    <table >
        <thead>
            <tr>

                <th >Mata Kuliah</th>
                <th >SKS</th>
                <th >Semester</th>
                <th >Nilai</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($Mahasiswa->mataKuliah as $matkul)
            <tr>
                <td class="text-left">{{ $matkul->nama_matkul }}</td>
                <td >{{ $matkul->sks }}</td>
                <td >{{ $matkul->semester }}</td>
                <td >{{ $matkul->pivot->nilai }}</td>
            </tr>
    @endforeach

        </tbody>
    </table>
</body>
