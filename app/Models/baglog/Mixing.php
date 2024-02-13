<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mixing extends Model
{
    use HasFactory;

    protected $table = 'baglog_mixing';

    protected $fillable = [
        'NoRecipe',
        'TanggalMixing',
        'Status',
        'Keterangan',
        'BatchSterilisasi',
        'TanggalSterilisasi',
        'StatusSterilisasi',
        'UserID',
    ];
}
