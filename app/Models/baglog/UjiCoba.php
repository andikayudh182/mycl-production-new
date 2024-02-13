<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjiCoba extends Model
{
    use HasFactory;
    protected $table = 'baglog_uji_coba';

    protected $fillable = [
        'BaglogID',
        'Tanggal',
        'Jumlah',
        'Keterangan',
    ];
}
