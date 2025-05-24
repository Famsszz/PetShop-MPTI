<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail
{
    private static $makanan =[
        [
        "makanan" => "whiskas",
         "detail" => "Makanan ini sehat untuk anak kucing umur 2 minggu",
         "harga" => "20.000",
         ]
     ];
 
     public static function all()
     {
         return self::$makanan;
     }
}
