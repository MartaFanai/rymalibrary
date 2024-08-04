<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public function records()
    {
        return $this->hasMany('App\Record');
    }
}
