<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function payment()
    {
        $this->hasMany(Payment::class, 'id', 'customer_id');
    }
}
