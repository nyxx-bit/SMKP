<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    protected $fillable = [
        'gaji_pokok',
        'tunjangan'
    ];
    public $timestamps = false;
}
