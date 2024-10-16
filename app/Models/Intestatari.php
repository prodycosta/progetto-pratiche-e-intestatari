<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intestatari extends Model
{
    use HasFactory;
    protected $table = 'intestatari';
    protected $fillable = [
        'nome',
        'cognome',
        'cap',
        'indirizzo',
        'numero_civico',
        'comune',
        'provincia',
        'numero_documento',
        'scadenza_documento',
        'codice_fiscale',
        'data_nascita',
        'numero_telefono',
        'id_utente',
    ];
    public function utente()
    {
        return $this->belongsTo(Utente::class, 'id_utente');
    }
    public function pratiche()
{
    return $this->belongsToMany(Pratica::class, 'intestatari_pratica', 'id_intestatario', 'id_pratica' );
}
}
