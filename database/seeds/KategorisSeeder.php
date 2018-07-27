<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;
use App\BorrowLog;
use App\User;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Author sample
        $author1 = Kategori::create(['nama_kategori' => 'M. Rudyanto Arief']);
        $author2 = Kategori::create(['nama_kategori' => 'Yudhi Purwanto']);
        $author3 = Kategori::create(['nama_kategori' => 'Andy Harris']);
        $author4 = Kategori::create(['nama_kategori' => 'Achmad Solichin']);
        $author5 = Kategori::create(['nama_kategori' => 'A.M. HIRIN & VIRGI']);

    }
}
