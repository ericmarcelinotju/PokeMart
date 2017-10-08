<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
	protected $table = 'pokemons';

    public function element(){
    	return $this->belongsTo(ELement::class);
    }

    public function comments(){
    	return $this->hasMany(Comment::class);
    }
}
