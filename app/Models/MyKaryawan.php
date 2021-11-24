<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyKaryawan extends Model
{
    use HasFactory;
    protected $table = 'mykaryawan';
    protected $fillable = [
        'nama_lengkap', 
        'telp', 
        'asal',
        'Kontrak',
        'nama_jabatan',
        'gaji_pokok',
        'tunjangan'
    ];
    public $timestamps = false;
}
