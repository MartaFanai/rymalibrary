<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returnreport extends Model
{
    public function member()
    {
    	return $this->belongsTo('App\Members');
        
    }

    public function book()
    {
    	return $this->belongsTo('App\Book');
        
    }
}
