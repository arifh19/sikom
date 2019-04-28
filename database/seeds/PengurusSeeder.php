<?php

use Illuminate\Database\Seeder;
use App\Pengurus;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengurus = new Pengurus();
        $pengurus->nama_pengurus = 'Noviana Widya Ningrum';
        $pengurus->nim = '-';
        $pengurus->fakultas = 'Sekolah Vokasi';
        $pengurus->prodi = "Teknologi Reyakasa Internet";
        $pengurus->kontak = '-';
        $pengurus->divisi_id = 4;
        $pengurus->user_id = 1;
        $pengurus->jabatan_id = 5;
        $pengurus->save();

        $pengurus1 = new Pengurus();
        $pengurus1->nama_pengurus = 'Muhammad Hanif Muallif';
        $pengurus1->nim = '-';
        $pengurus1->fakultas = 'Fakultas MIPA';
        $pengurus1->prodi = "Elektronika dan Instrumentasi";
        $pengurus1->kontak = '-';
        $pengurus1->divisi_id = 4;
        $pengurus1->user_id = 2;
        $pengurus1->jabatan_id = 6;
        $pengurus1->save();

        $pengurus2 = new Pengurus();
        $pengurus2->nama_pengurus = 'Muhammad Fitroh Fajariyadi';
        $pengurus2->nim = '-';
        $pengurus2->fakultas = 'Fakultas Teknik';
        $pengurus2->prodi = "Teknik Elektro";
        $pengurus2->kontak = '-';
        $pengurus2->divisi_id = 4;
        $pengurus2->user_id = 3;
        $pengurus2->jabatan_id = 6;
        $pengurus2->save();

        $pengurus3 = new Pengurus();
        $pengurus3->nama_pengurus = 'Muhammad Alifsyah Putra Nasution';
        $pengurus3->nim = '-';
        $pengurus3->fakultas = 'Fakultas Teknik';
        $pengurus3->prodi = "Teknik Elektro";
        $pengurus3->kontak = '-';
        $pengurus3->divisi_id = 4;
        $pengurus3->user_id = 1;
        $pengurus3->jabatan_id = 6;
        $pengurus3->save();

        $pengurus4 = new Pengurus();
        $pengurus4->nama_pengurus = 'Sholihatul Richas';
        $pengurus4->nim = '-';
        $pengurus4->fakultas = 'Fakultas MIPA';
        $pengurus4->prodi = "Elektronika dan Instrumentasi";
        $pengurus4->kontak = '-';
        $pengurus4->divisi_id = 4;
        $pengurus4->user_id = 2;
        $pengurus4->jabatan_id = 6;
        $pengurus4->save();

        $pengurus4 = new Pengurus();
        $pengurus4->nama_pengurus = 'Achmad Muammar Afinas';
        $pengurus4->nim = '-';
        $pengurus4->fakultas = 'Sekolah Vokasi';
        $pengurus4->prodi = "Teknologi Reyakasa Internet";
        $pengurus4->kontak = '-';
        $pengurus4->divisi_id = 4;
        $pengurus4->user_id = 62;
        $pengurus4->jabatan_id = 6;
        $pengurus4->save();
    }
}
