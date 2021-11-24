<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawancuti extends Model
{
    use HasFactory;
    protected $table = 'karyawancuti';
    protected $fillable = [
        'nama_lengkap', 
        'nama_jabatan', 
        'tanggalmulai',
        'tanggalakhir',
        'keterangan'
    ];
    public $timestamps = false;
}
