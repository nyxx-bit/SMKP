<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $fillable = [
        'nama_lengkap',
        'telp',
        'asal',
        'kontrak',
        'jabatan_id',
        'gaji_id',
        'cuti_id',
        'proyek_id'
    ];
    public $timestamps = false;
}
