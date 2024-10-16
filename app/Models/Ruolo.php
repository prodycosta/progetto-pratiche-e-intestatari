<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruolo extends Model
{
    use HasFactory;

    protected $table = 'ruoli';
    protected $fillable = ['nome'];

    public function utenti()
    {
        return $this->hasMany(Utente::class, 'ruolo');
    }
}
