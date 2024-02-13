<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositeBaglogPemakaian extends Model
{
    use HasFactory;


    protected $table = 'composite_baglog_pemakaian';

    protected $fillable = [
        'CompositeID',
        'KodeComposite',
        'KodeBaglog',
        'Jumlah',
    ];
}
