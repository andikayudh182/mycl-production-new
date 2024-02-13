<?php

namespace App\Models\Composite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositeVariant extends Model
{
    use HasFactory;

    protected $table = 'composite_variant';

    protected $fillable = [
        'Nama',
        'Keterangan',
        'InkubasiSatu',
        'InkubasiDua',
        'InkubasiTiga',
    ];
}
