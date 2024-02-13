<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontaminasi extends Model
{
    use HasFactory;

    protected $table = 'baglog_kontaminasi';

    protected $fillable = [
        'KodeProduksi',
        'Tanggal',
        'JumlahKontaminasi',
        'Keterangan',
    ];
}
