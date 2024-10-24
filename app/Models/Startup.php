<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',                
        'description',
        'tempo_disponivel',
        'tecnologias',
        'user_id',         
        'contato_informacao',
        'licenca',
        'tags',
    ];

    // O método belongsTo() indica que a model Startup está relacionada a um único registro na model User, através da chave estrangeira user_id
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
