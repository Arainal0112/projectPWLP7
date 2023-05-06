<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas; 
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

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
            return view('mahasiswas.index', compact('mahasiswas')); 
        }
    }

    public function create()
    {
        $kelas = Kelas::all(); // mendapatkan data dari kelas
        return view('mahasiswas.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image')){
            $image_name = $request->file('image')->store('foto_mahasiswas', 'public');
        }
        //melakukan validasi data
        $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'tgl_lahir' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required',
        'email' => 'required',
        'no_hp' => 'required',
        ]);
        //jobsheet 7
        // //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());
        // //jika data berhasil ditambahkan, akan kembali ke halaman utama
        // return redirect()->route('mahasiswas.index')
        // ->with('success', 'Mahasiswa Berhasil Ditambahkan');

        //jobsheet 9
        //Fungsi eloquent untuk tambah data
        $mahasiswas= new Mahasiswa;
        $mahasiswas->nim=$request->get('nim');
        $mahasiswas->nama=$request->get('nama');
        $mahasiswas->foto = $image_name;
        $mahasiswas->tgl_lahir=$request->get('tgl_lahir');
        $mahasiswas->jurusan=$request->get('jurusan');
        $mahasiswas->email=$request->get('email');
        $mahasiswas->no_hp=$request->get('no_hp');
        

        //Unutk menambahkan dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        //jika data berhasil
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil ditambahkan');
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
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa','kelas'));
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
        $mahasiswas = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        if ($mahasiswas->foto && file_exists(storage_path('app/public/' . $mahasiswas->foto))) {
            Storage::delete('public/' . $mahasiswas->foto);  
        }
        $image_name = $request->file('image')->store('foto_mahasiswas', 'public');
        //melakukan validasi data
        $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'tgl_lahir' => 'required',
        'kelas' => 'required',
        'jurusan' => 'required',
        'email' => 'required',
        'no_hp' => 'required',
        ]);
        // //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($nim)->update($request->all());
        // //jika data berhasil diupdate, akan kembali ke halaman utama
        // return redirect()->route('mahasiswas.index')
        // ->with('success', 'Mahasiswa Berhasil Diupdate');
        
        //jobsheet 9
        //Fungsi eloquent untuk tambah data
        $mahasiswas=Mahasiswa::with('kelas')->where('nim',$nim)->first();
        $mahasiswas->nim=$request->get('nim');
        $mahasiswas->nama=$request->get('nama');
        $mahasiswas->foto = $image_name;
        $mahasiswas->tgl_lahir=$request->get('tgl_lahir');
        $mahasiswas->jurusan=$request->get('jurusan');
        $mahasiswas->email=$request->get('email');
        $mahasiswas->no_hp=$request->get('no_hp');
        $mahasiswas->save();

        //Unutk menambahkan dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        //jika data berhasil
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil di Update');
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

    public function nilai($nim)
    {
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.nilai', compact('Mahasiswa'));
    }
    public function cetak_khs($nim){
        $Mahasiswa = Mahasiswa::find($nim);
        $pdf = PDF::loadview('mahasiswas.cetak_khs',compact('Mahasiswa'));
        return $pdf->stream();
    }

    
}
