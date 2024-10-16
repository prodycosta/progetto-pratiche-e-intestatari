<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatoPratica extends Model
{
    use HasFactory;

    protected $table = 'stato_pratica';

    protected $fillable = [
        'id_stato',
        'nome',
    ];

    public function pratiche()
    {
        return $this->hasMany(Pratica::class, 'id_stato');
    }
}
