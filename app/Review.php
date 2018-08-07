<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'proposal_id', 'is_review'];
    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
