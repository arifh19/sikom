<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Laratrust\Traits\LaratrustUserTrait;
use App\Exceptions\BookException;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $casts = [
        'is_verified'   =>  'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function review(Komentar $komentar)
    {
        // Cek apakah dosen sudah pernah mereview proposal tersebut
        if ($this->Reviews()->where('proposal_id', $komentar->proposal_id)->where('user_id',$this->id)->count() > 0) {
            $review = $this->Reviews()->where('proposal_id', $komentar->proposal_id)->where('user_id',$this->id)->first();
            $review->is_review = 1;
            $review->save();
        }
        else{
            $review = Review::create(['user_id' => $this->id, 'proposal_id' => $komentar->proposal_id, 'is_review' => 1]);
        }
    }

    public function reviewStaff(RiwayatProposal $komentar)
    {
        // Cek apakah dosen sudah pernah mereview proposal tersebut
        if ($this->Reviews()->where('proposal_id', $komentar->proposal_id)->where('user_id',$this->id)->count() > 0) {
            $review = $this->Reviews()->where('proposal_id', $komentar->proposal_id)->where('user_id',$this->id)->first();
            $review->is_review = 1;
            $review->save();
        }
        else{
            $review = Review::create(['user_id' => $this->id, 'proposal_id' => $komentar->proposal_id, 'is_review' => 1]);
        }
    }

    public function Reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function Komentars()
    {
        return $this->hasMany('App\Komentar');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
    public function verify()
    {
        $this->is_verified = 1;
        $this->verification_token = null;
        $this->save();
    }

    public function generateVerificationToken()
    {
        $token = $this->verification_token;

        if (!$token) {
            
            $token = str_random(40);
            $this->verification_token = $token;
            $this->save();
        }

        return $token;
    }

    public function sendVerification()
    {
        $token = $this->generateVerificationToken();
        $user = $this;

        Mail::send('auth.emails.verification', compact('user', 'token'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Verifikasi Akun SIKOMATIK');
        });
    }
}
