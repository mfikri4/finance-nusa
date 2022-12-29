<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailer extends Model
{
    use HasFactory;
    protected $table = 'mailer';
    protected $primaryKey = "id_verifikasi";
    protected $fillable = [
        'email',
        'pin',
        'status_verified', 
    ];

    public static $rules = [
        'email'             => 'required',
        'pin'               => 'required',
        'status_verified'   => 'required',
    ]; 
}
