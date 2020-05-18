<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eating extends Model
{
    protected $table = "eatings";

    protected $fillable = [
        'user_id',
        'thucpham_id',
        'sogram',
        'ngay'
    ];

    public function thucpham()
    {
        return $this->belongsTo(App\ThucPham::class, 'thucpham_id');
    }
}
