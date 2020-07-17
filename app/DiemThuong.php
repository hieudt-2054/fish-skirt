<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiemThuong extends Model
{
    protected $table = "diemthuong";

    protected $fillable = [
        'user_id',
        'card',
        'value_card',
        'status',
        'answer'
    ];
}
