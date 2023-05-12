<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = 'shipings'; 

    protected $fillable = [
        "first_name",
        "last_name",
        "u_id",
        "c_id",
        "addres",
        "add_t",
        "city" ,
        "state",
        "city_code",
        "email",
        "phone_number"
    ];
}
