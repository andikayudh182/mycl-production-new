<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'mylea_pt_pemakaian';

    protected $fillable = [
        'id_details',
        'Tanggal',
        'Jumlah',
        'Notes',
    ];
}
