<?php

namespace App\Models\Biobo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianPT extends Model
{
    use HasFactory;
    protected $table = 'biobo_pemakaian_pt';

    protected $fillable = [
        'Harvest_ID',
        'PT1_ID',
        'Jumlah',
    ];
}
