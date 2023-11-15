<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketings extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function penjualans()
    {
        return $this->hasMany(Penjualans::class);
    }
}
