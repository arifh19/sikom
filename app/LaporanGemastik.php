<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanGemastik extends Model
{
    protected $fillable = [
        'judul', 'kategori_id','video','laporan','user_id','aplikasi',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
