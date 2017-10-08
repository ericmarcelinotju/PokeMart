<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function pokemons(){
    	return $this->belongsToMany(Pokemon::class)->withPivot('quantity')->withTimestamps();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
