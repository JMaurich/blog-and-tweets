<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //relaciona las entradas con los usuarios
    // es una relacion de uno a muchos

    public function user()
    {
    	return $this->belongsto(user::class);
    }
}
