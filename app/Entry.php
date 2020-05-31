<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Entry extends Model
{
    //relaciona las entradas con los usuarios
    // es una relacion de uno a muchos

    public function user()
    {
    	return $this->belongsto(user::class);
    }
    // Mutator
    public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = $value;
    	$this->attributes['slug'] = Str::slug($value);
    }

   
    public function getUrl()
    {

        return url("entries/$this->slug-$this->id");
    }
}
