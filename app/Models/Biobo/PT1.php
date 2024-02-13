<?php

namespace App\Models\Biobo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PT1 extends Model
{
    use HasFactory;

    protected $table = 'biobo_pt1';

    protected $fillable = [
        'NoBatch',
        'Tanggal',
        'U10x15',
        'U10x20',
        'U30x30',
        'TanggalDrying',
        'PDrying10x15',
        'PDrying10x20',
        'PDrying30x30',
        'TanggalPressing',
        'PPressing10x15',
        'PPressing10x20',
        'PPressing30x30',
    ];
}
