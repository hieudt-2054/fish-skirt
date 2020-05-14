<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThucPham extends Model
{
    protected $table = "thucphams";

    protected $fillable = [
        'id',
        'tensp',
        'nangluong',
        'chatbeo',
        'chatxo',
        'duong',
        'vitamina',
        'vitaminc',
        'canxi',
        'sat',
        'giamcan',
        'suckhoe',
        'tangcan',
        'caloriefromprotein',
        'caloriefromcarb',
        'caloriefromfat',
        'uudiem',
        'khuyetdiem'
    ];
}
