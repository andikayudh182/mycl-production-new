<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPT1 extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_mpt1';

    protected $fillable = [
        'KodeProduksi',
        'StatusWashing',
        'TanggalWashing',
        'StatusPengerikan',
        'TanggalPengerikan',
        'StatusScoringDyeing',
        'TanggalScoringDyeing',
        'StatusWashingDrying',
        'TanggalPWashingDrying',
        'StatusPEGDrying',
        'TanggalPEGDrying',
    ];
}
