<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswas')->insert([
            'nim' => '2141720042',
            'nama' => 'Arainal Aldiansyah',
            'kelas' => 'TI-2G',
            'jurusan' => 'Teknologi Informasi',
            'no_hp' => '081391484458'
            
        ]);
    }
}
