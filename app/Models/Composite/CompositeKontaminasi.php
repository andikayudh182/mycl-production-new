<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositeKontaminasi extends Model
{
    use HasFactory;

    protected $table = 'composite_kontaminasi';

    protected $fillable = [
        'CompositeID',
        'KodeProduksi',
        'TanggalKonta',
        'Jumlah',
        'Keterangan',
    ];
}
