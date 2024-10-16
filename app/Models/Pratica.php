<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Allegato;

class Pratica extends Model
{

    use HasFactory;
    protected $casts = [
        'id_intestatari' => 'json',
    ];
    protected $table = 'pratiche';
    protected $fillable = [
        'indirizzo',
        'numero_civico',
        'provincia',
        'comune',
        'cap',
        'anni_contratto',
        'id_utente',
        'id_intestatari',
        'created_at',
        'updated_at',
        'id_stato',
        'created_at'
    ];

    public function utente()
    {
        return $this->belongsTo(Utente::class, 'id_utente');
    }
    public function statoPratica()
    {
        return $this->belongsTo(StatoPratica::class, 'id_stato');
    }
    public function intestatari()
    {
        return $this->belongsToMany(Intestatari::class, 'intestatari_pratica', 'id_pratica', 'id_intestatario');
    }
    public function allegati(): HasMany
    {
        return $this->hasMany(Allegato::class, 'id_pratica');
    }
    public function stato()
    {
        return $this->belongsTo(StatoPratica::class, 'id_stato');
    }

    public function getIntestatariListAttribute()
    {
        return $this->intestatari->pluck('nome', 'id')->toArray();
    }
}
