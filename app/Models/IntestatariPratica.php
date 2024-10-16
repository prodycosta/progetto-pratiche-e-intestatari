<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntestatariPratica extends Model
{
    use HasFactory;

    protected $table = 'intestatari_pratica';
    protected $fillable = ['id_pratica', 'id_intestatario'];
}
