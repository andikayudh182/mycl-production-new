<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityDetails2 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_quality_details_2';

    protected $fillable = [
        'KodeProduksi',
        'KategoriReinforce',
        'Warna',
        'Grade',
        'Jumlah',
        'Ukuran',
    ];
}
