<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        if($request->has('nama')) {
            $nama = request('nama');
            $mahasiswas = Mahasiswa::where('nama', 'LIKE', '%'.$nama.'%')->paginate(5);
            return view('mahasiswas.index', compact('mahasiswas'));
        } else {
            // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
            $mahasiswas = Mahasiswa::orderBy('nim', 'desc')->paginate(5);
            return view('mahasiswas.index', compact('mahasiswas'))
            ->with('i', (request()->input('page', 1) - 1) * 5); 
        }
        
        
    }

    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'ttl' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required',
        'email' => 'required',
        'no_hp' => 'required',
        ]);
        //fungsi eloquent untuk menambah data
        Mahasiswa::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'ttl' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required',
        'email' => 'required',
        'no_hp' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::find($nim)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswas.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    
}
