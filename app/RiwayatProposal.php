<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatProposal extends Model
{
    protected $fillable = ['user_id', 'proposal_id', 'status','keterangan'];
    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
