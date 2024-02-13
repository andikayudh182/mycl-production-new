<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPT4 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_mpt4';

    protected $fillable = [
        'KodeProduksi',
        'Grade',
        'StatusCutting',
        'TanggalCutting',
        'StatusCoatingPigmen',
        'TanggalCoatingPigmen',
        'StatusPengeringan4',
        'TanggalPengeringan4',
    ];
}
