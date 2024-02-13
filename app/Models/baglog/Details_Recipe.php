<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_Recipe extends Model
{
    use HasFactory;

    protected $table = 'baglog_details_recipes';

    protected $fillable = [
        'NoRecipe',
        'JenisAutoclave',
        'TanggalKeluar',
        'TotalBags',
        'JenisBibit',
        'WeightperBag',
    ];

    public function bahan(){
        return $this->hasOne(Bahan_Recipe::class);
    }
}
