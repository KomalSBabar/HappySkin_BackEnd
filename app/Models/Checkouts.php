<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkouts extends Model
{
    use HasFactory;
    protected $fillable=[


        'u_id',
        'c_id',
        'card_id',
        'order_status',
        'order_number',
        'payment_status',
        'ship_add_id'



    ];
}
