<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPT2 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_mpt2';

    protected $fillable = [
        'KodeProduksi',
        'Grade',
        'StatusReinforceDrying',
        'TanggalReinforceDrying',
    ];
}
