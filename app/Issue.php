<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'book_id','member_id','issueDate', 'retDate'
    ];

    public function book()
    {
    	return $this->belongsTo('App\Book'); 
    }

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }

    public function member()
    {
    	return $this->belongsTo('App\Members'); 
    }
}
