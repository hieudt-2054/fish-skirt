<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpendCategory extends Model
{
    protected $table = "spend_categories";

    protected $fillable = [
        'name'
    ];
}
