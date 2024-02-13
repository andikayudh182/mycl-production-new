<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaReminder extends Model
{
    use HasFactory;

    protected $table = 'mylea_reminder';

    protected $fillable = [
        'KodeProduksi',
        'Elus1',
        'Elus2',
        'Elus3',
        'TanggalPanen',
        'PanenBiobo'
    ];
}
