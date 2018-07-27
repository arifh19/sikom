<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['konten', 'proposal_id'];

    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
