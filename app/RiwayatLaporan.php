<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatLaporan extends Model
{
    public function laporan()
    {
        return $this->belongsTo('App\LaporanGemastik');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
