<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveys extends Model
{
    use HasFactory;
    protected $table = 'survey'; 
    protected $fillable = [
        "user_id",
        "response_first",
        "response_second",
    ];
}
