<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok_masuk extends Model
{
    protected $table = 'stok_masuk';
    protected $primaryKey = 'ID_StokMasuk';
    use HasFactory;
}
