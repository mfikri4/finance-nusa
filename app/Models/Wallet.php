<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallet';
    protected $primaryKey = "id_wallet";
    protected $fillable = [
        'id_currency',
        'id_user',
        'amount',
    ];

    public static $rules = [
        'id_currency'       => 'required',
        'id_user'           => 'required',
        'amount'            => 'required',
    ]; 
}
