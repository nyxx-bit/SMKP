<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawanproyek extends Model
{
    use HasFactory;
    protected $table = 'karyawanproyek';
    protected $fillable = [
        'nama_proyek',
        'nama_lengkap', 
        'tenggatwaktu', 
        'keterangan'
    ];
    public $timestamps = false;
}
