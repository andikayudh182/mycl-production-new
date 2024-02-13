<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Kartu_Kendali extends Model
{
    use HasFactory;

    use Sortable;

    protected $table = 'baglog_kartu_kendali';

    protected $fillable = [
        'SterilisasiID',
        'UserID',
        'KodeProduksi',
        'TanggalBibit',
        'JumlahBibit',
        'KeteranganBibit',
        'TanggalPembibitan',
        'TanggalCrushing',
        'TanggalHarvest',
        'JumlahBaglog',
        'Lokasi',
        'Keterangan',
        'Status',
    ];

    protected $sortable = [
        'SterilisasiID',
        'UserID',
        'KodeProduksi',
        'TanggalBibit',
        'JumlahBibit',
        'KeteranganBibit',
        'TanggalPembibitan',
        'TanggalCrushing',
        'TanggalHarvest',
        'JumlahBaglog',
        'Lokasi',
        'Keterangan',
        'Status',
    ];
    
}
