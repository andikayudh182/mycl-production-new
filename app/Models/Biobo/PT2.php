<?php

namespace App\Models\Biobo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PT2 extends Model
{
    use HasFactory;

    protected $table = 'biobo_pt2';

    protected $fillable = [
        'PT1_ID',
        'NoBatch',
        'Tanggal',
        'U10x15',
        'U10x20',
        'U30x30',
        'TanggalSanding',
        'PSanding10x15',
        'PSanding10x20',
        'PSanding30x30',
        'TanggalCutting',
        'PCutting10x15',
        'PCutting10x20',
        'PCutting30x30',
    ];
}
