<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author_id', 'edition', 'volume', 'year', 'publisher_id', 'pages', 'accessionno', 'classificationno', 'subject', 'bookno', 'description', 'price', 'location'
    ];

    public function issue()
    {
    	return $this->hasMany('App\Issue'); 
    }

    public function receipt()
    {
    	return $this->hasMany('App\Receipt'); 
    }

    public function member()
    {
    	return $this->belongsTo('App\Members');
    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }
 
}
