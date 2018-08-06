<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kategori sample
        $kategori1 = Kategori::create(['nama_kategori' => 'Animasi']);
        $kategori2 = Kategori::create(['nama_kategori' => 'Desain Pengalaman Pengguna(UX)']);
        $kategori3 = Kategori::create(['nama_kategori' => 'Keamanan Jaringan dan Sistem Informasi']);
        $kategori4 = Kategori::create(['nama_kategori' => 'Pemrograman']);
        $kategori5 = Kategori::create(['nama_kategori' => 'Penambangan Data(Data Mining)']);
        $kategori6 = Kategori::create(['nama_kategori' => 'Pengembangan Aplikasi Permainan']);
        $kategori7 = Kategori::create(['nama_kategori' => 'Pengembangan Perangkat Lunak']);
        $kategori8 = Kategori::create(['nama_kategori' => 'Pengembangan Bisnis TIK']);
        $kategori9 = Kategori::create(['nama_kategori' => 'Piranti Cerdas, Sistem Benam dan IoT']);
        $kategori10 = Kategori::create(['nama_kategori' => 'Kota Cerdas (Smart City)']);
        $kategori10 = Kategori::create(['nama_kategori' => 'Karya Tulis Ilmiah TIK']);

    }
}
