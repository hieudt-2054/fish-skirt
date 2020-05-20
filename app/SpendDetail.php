<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpendDetail extends Model
{
    protected $table = "spend_details";
    const CHI = 2;
    const THU = 1;
    protected $fillable = [
        'user_id',
        'sotien',
        'category_id',
        'loai_id',
        'ngay',
        'mota'
    ];
}
