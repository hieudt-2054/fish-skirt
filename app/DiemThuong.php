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

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
