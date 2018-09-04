<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = ['lampiran', 'proposal_id','komentar_id','user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function komentar()
    {
        return $this->belongsTo('App\Komentar');
    }
}
