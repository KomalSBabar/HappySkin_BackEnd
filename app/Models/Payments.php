<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable=[
        'u_id',
        'c_id',
        'o_id',
        'status',
        'date'
    ];
}
