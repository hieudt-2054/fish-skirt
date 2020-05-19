<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CanNang extends Model
{
    protected $table = "cannangs";

    protected $fillable = [
        'user_id',
        'socan',
        'ngay'
    ];
}
