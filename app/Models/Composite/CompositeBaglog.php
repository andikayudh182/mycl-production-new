<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositeBaglog extends Model
{
    use HasFactory;


    protected $table = 'composite_baglog';

    protected $fillable = [
        'CompositeID',
        'KodeComposite',
        'KodeBaglog',
        'Jumlah',
    ];
}
