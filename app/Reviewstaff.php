<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewstaff extends Model
{
    protected $fillable = ['pengurus_id', 'divisi_id', 'status','keterangan'];

    public function pengurus()
    {
        return $this->belongsTo('App\Pengurus');
    }
    public function divisi()
    {
        return $this->belongsTo('App\Divisi');
    }
}
