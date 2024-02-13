<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaBaglog extends Model
{
    use HasFactory;

    protected $table = 'mylea_baglog';

    protected $fillable = [
        'KodeMylea',
        'KodeBaglog',
        'Jumlah',
    ];
}
