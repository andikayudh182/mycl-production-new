<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class CompositeProduction extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'composite_production';

    protected $fillable = [
        'KodeProduksi',
        'TanggalProduksi',
        'JenisBaglog',
        'JenisComposite',
        'JumlahComposite',
        'JumlahBaglog',
        'Lokasi',
        'Keterangan',
        'Status',
        'StatusHarvest',

    ];

    protected $sortable = [
        'KodeProduksi',
        'TanggalProduksi',
        'JenisBaglog',
        'JenisComposite',
        'JumlahComposite',
        'JumlahBaglog',
        'Lokasi',
        'Keterangan',
        'Status',
        'StatusHarvest',

    ];
}
