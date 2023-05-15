<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class billing_addres extends Model
{
    use HasFactory;
    protected $table = 'table_billing_addres'; 

    protected $fillable = [
        "u_id",
        "c_id",
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
