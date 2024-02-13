<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControl1 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_quality_control_1';

    protected $fillable = [
        'KodeProduksi',
        'KPMylea',
        'ArrivalDate',
        'JenisMylea',
        'GradeA',
        'GradeE',
    ];
}
