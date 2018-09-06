<?php

use Illuminate\Database\Seeder;
use App\Divisi;
use App\Jabatan;

class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kategori sample
        $divisi1 = Divisi::create(['divisi' => 'Pengurus Harian']);
        $divisi2 = Divisi::create(['divisi' => 'Kesekretariatan']);
        $divisi3 = Divisi::create(['divisi' => 'Media Informasi']);
        $divisi4 = Divisi::create(['divisi' => 'Event Organizer dan Kreatif']);
        $divisi5 = Divisi::create(['divisi' => 'Sarana dan Prasarana']);
        $divisi6 = Divisi::create(['divisi' => 'Humas, Kerjasama dan Alumni']);
        $divisi7 = Divisi::create(['divisi' => 'Pengembangan Sumber Daya Manusia']);

        $jabatan1 = Jabatan::create(['jabatan' => 'Ketua']);
        $jabatan2 = Jabatan::create(['jabatan' => 'Wakil Ketua']);
        $jabatan3 = Jabatan::create(['jabatan' => 'Sekretaris']);
        $jabatan4 = Jabatan::create(['jabatan' => 'Bendahara']);
        $jabatan5 = Jabatan::create(['jabatan' => 'Kepala Divisi']);
        $jabatan6 = Jabatan::create(['jabatan' => 'Staff']);
        $jabatan7 = Jabatan::create(['jabatan' => 'Anggota']);
    }
}
