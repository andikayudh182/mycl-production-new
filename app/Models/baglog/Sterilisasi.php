<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sterilisasi extends Model
{
    use HasFactory;

    protected $table = 'baglog_sterilisasi';

    protected $fillable = [
        'NoRecipe',
        'TanggalSterilisasi',
        'Status',
        'NoBatch',
        'JenisAutoclave',
        'Jumlah',
        'Keterangan',
        'UserID',
        'MixingID',
    ];
}
