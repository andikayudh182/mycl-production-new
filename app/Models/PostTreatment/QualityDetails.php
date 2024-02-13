<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityDetails extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_quality_details';

    protected $fillable = [
        'KodeProduksi',
        'KategoriReinforce',
        'Warna',
        'Grade',
        'Jumlah',
    ];
}
