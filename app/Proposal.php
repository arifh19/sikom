<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = ['judul', 'kategori_id','upload'];

    protected $casts = [
        'is_lock'   =>  'boolean',
    ];

    //relasi
    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function komentars()
    {
        return $this->hasMany('App\komentar');
    }
    public function Reviews()
    {
        return $this->hasMany('App\Review');
    }
}
