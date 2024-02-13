<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositeReminder extends Model
{
    use HasFactory;

    protected $table = 'composite_reminder';

    protected $fillable = [
        'CompositeID',
        'KodeProduksi',
        'TanggalBukaCetakan',
        'TanggalInkubasi',
        'TanggalPanen',
    ];
}
