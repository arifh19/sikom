<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['proposal_id',
        'Ide_konsep_keaslian','Konsistensi_tema','Kreativitas_dalam_implementasi','Teknik_modelling_lighting_motion','Kekuatan_pesan_artistik',
        'Identifikasi_permasalahan','Inovasi_desain','Metode_Desain','Prototype','Komunikasi','Komunikasi',
        'originalitas','kebaruan','manfaat','clarity','kelengkapan_laporan',
        'Story','Mechanics','Aesthetics','Gameplay','kesesuaian_proposal',
        'Aspek_Inovasi','Dampak_pengguna_masyarakat','Desain_dan_usability','metodologi_pengembangan','Kesesuaian_ide','Urgensi_permasalahan',
        'Penjelasan_Problem_Bisnis','Produk_Layanan','Pasar_Market','Strategi_Bisnis','Anggota_Perusahaan','Daya_Tarik_Traction','Elevator_Pitch',
        'Aspek_kreativitas','Penulisan_proposal','Potensi_Kegunaan_Hasil_Bagi_Masyarakat','Kemungkinan_Proposal_Dapat_Diselesaikan',
        'Permasalahan_yang_diangkat','Pemaparan_permasalahan','Dampak_implementasi','Inovasi_pengembangan',
        'judul','abstrak','pendahuluan','tujuan','metode','hasil_pembahasan','kesimpulan','daftar_pustaka'];

    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
