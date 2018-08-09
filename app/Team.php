<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['kategori_id','nama_ketua', 'nim_ketua', 'fkja_ketua', 'no_hp_ketua', 'foto_ktm_ketua',
            'nama_anggota1', 'nim_anggota1', 'fkja_anggota1', 'no_hp_anggota1', 'foto_ktm_anggota1',
            'nama_anggota2', 'nim_anggota2', 'fkja_anggota2', 'no_hp_anggota2', 'foto_ktm_anggota2',
            'nama_dosbing','nidn'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
