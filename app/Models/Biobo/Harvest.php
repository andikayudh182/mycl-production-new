<?php

namespace App\Models\Biobo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    use HasFactory;

    protected $table = 'biobo_harvest';

    protected $fillable = [
        'TanggalPanen',
        'Quality',
        'Ukuran',
        'TanggalProduksi',
        'Jumlah',
    ];
}
