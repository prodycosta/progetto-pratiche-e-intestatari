<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allegato extends Model
{
    use HasFactory;
    protected $table = 'allegati';
    protected $fillable = [
        'file',
        'NomeFile',
        'id_pratica',
    ];

    public function pratica()
    {
        return $this->belongsTo(Pratica::class, 'id_pratica');
    }
}
