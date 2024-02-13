<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MyleaProduction extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'mylea_production';

    protected $fillable = [
        'KodeProduksi',
        'TanggalProduksi',
        'JenisBaglog',
        'JumlahBaglog',
        'Lokasi',
        'Keterangan',
        'Status',
        'StatusHarvest',
        'StatusBiobo',

    ];
    protected $sortable = [
        'KodeProduksi',
        'TanggalProduksi',
        'JenisBaglog',
        'JumlahBaglog',
        'Lokasi',
        'Keterangan',
        'Status',
        'StatusHarvest',
        'StatusBiobo',

    ];
}
