<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Intestatari;


class Utente extends Model implements AuthenticatableContract
{
    use Notifiable, Authenticatable, MustVerifyEmail, CanResetPassword;

    use HasFactory;

    protected $table = 'utenti';

    protected $fillable = [
        'nome',
        'cognome',
        'username',
        'password',
        'email',
        'data_creazione',
        'attivo',
        'ruolo',
        'remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ruolo()
    {
        return $this->belongsTo(Ruolo::class, 'ruolo');
    }

    public function intestatari(): HasMany
    {
        return $this->hasMany(Intestatari::class, 'id_utente');
    }

    public function pratiche(): HasMany
    {
        return $this->hasMany(Pratica::class, 'id_utente');
    }
    protected $rememberTokenName = 'remember_token';
    public function isAdmin()
    {
        return $this->ruolo === 1;
    }
}
