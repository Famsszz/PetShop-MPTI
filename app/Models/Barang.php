<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'ID_Barang';
    use HasFactory;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'ID_Transaksi');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'ID_Kategori');
    }
}