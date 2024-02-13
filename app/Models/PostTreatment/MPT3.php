<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPT3 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_mpt3';

    protected $fillable = [
        'KodeProduksi',
        'Grade',
        'StatusPressing',
        'TanggalPressing',
    ];
}
