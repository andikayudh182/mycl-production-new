<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaKonta extends Model
{
    use HasFactory;

    protected $table = 'mylea_kontaminasi';

    protected $fillable = [
        'KodeProduksi',
        'TanggalKonta',
        'Jumlah',
        'Keterangan',
    ];
}
