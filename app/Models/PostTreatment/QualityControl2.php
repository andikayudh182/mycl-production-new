<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControl2 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_quality_control_2';

    protected $fillable = [
        'KodeProduksi',
        'FinishDate',
        'Jumlah',
    ];
}
