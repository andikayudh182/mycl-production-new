<?php

namespace App\Models\baglog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan_Recipe extends Model
{
    use HasFactory;

    protected $table = 'baglog_bahan_recipes';

    protected $fillable = [
        'NoRecipe',
        'MCHickory',
        'MCSKayu',
        'NoKontHickory',
        'NoKontSKayu',
        'NoKontCaCO3',
        'NoKontPollard',
        'NoKontTapioka',
        'Hickory',
        'SKayu',
        'CaCO3',
        'Pollard',
        'Tapioka',
        'Air',
    ];

    public function detail(){
        return $this->hasOne(Bahan_Recipe::class);
    }
}
