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
        'khuyetdiem',
        'user_id',
        'status',
        'note'
    ];

    public function eatings()
    {
        return $this->hasMany(\App\Eating::class, 'thucpham_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
