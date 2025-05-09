<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory;

    protected $fillable = [
        'investimentos',
        'user_id',
        'startup_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
