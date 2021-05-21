<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function produtos(){
        return $this->belongsToMany(Produto::class);
    }
}
