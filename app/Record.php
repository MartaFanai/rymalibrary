<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
