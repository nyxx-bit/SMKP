<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    protected $table = 'proyek';
    protected $fillable = [
        'nama_proyek',
        'tenggat_waktu',
        'keterangan'
    ];
    public $timestamps = false;
}
