<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaBaglogPemakaian extends Model
{
    use HasFactory;

    protected $table = 'mylea_baglog_pemakaian';

    protected $fillable = [
        'KodeMylea',
        'KodeBaglog',
        'Jumlah',
    ];
}
