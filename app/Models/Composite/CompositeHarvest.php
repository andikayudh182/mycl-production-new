<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositeHarvest extends Model
{
    use HasFactory;
    protected $table = 'composite_harvest';

    protected $fillable = [
        'CompositeID',
        'KodeProduksi',
        'JenisPanen',
        'Passed',
        'Reject',
        'Keterangan'
    ];
}
