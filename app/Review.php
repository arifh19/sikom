<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function proposal()
    {
        return $this->belongsTo('App\Proposal');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
