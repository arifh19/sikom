<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }

    protected $fillable = ['nama_kategori'];

    public static function boot()
    {
        parent::boot();

        self::deleting(function($kategori) {

            // Mengecek apakah kategori masih mempunyai proposal
            if ($kategori->proposals->count() > 0) {

                // Menyiapkan pesan error
                $html = 'Kategori tidak bisa dihapus karena masih memiliki Proposal : ';
                $html .= '<ul>';
                foreach ($kategori->proposals as $proposal) {
                    $html .= "<li>$proposal->judul</li>";
                }

                $html .= '</ul>';

                Session::flash("flash_notification", [
                    "level" => "danger",
                    "icon" => "fa fa-ban",
                    "message" => $html
                ]);

                // Membatalkan proses penghapusan
                return false;
            }
        });
    }
}
