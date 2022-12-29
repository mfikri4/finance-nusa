<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currency';
    protected $primaryKey = "id_currency";
    protected $fillable = [
        'name_currency',
        'balance',
    ];

    public static $rules = [
        'name_currency'             => 'required',
        'balance'               => 'required',
    ]; 
}
