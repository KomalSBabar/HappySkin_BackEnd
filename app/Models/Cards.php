<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    protected $table = 'table_cards'; 
    protected $fillable =[
        'card_number' ,
        'card_name' ,
        'expiry_date',
        'cvc_code',
        'address'
    ];
}
