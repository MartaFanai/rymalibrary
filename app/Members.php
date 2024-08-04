<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $fillable = [
        'name', 'relation', 'reationname', 'gender', 'section', 'mobile', 'address', 'image', 'id_number', 'rid', 'year', 'rating', 'rating_user' 
    ];

    public function issue()
    {
    	return $this->hasMany('App\Issue'); 
    }

    public function receipt()
    {
    	return $this->hasMany('App\Receipt');  
    }

    public function returnreport()
    {
        return $this->hasMany('App\Returnreport'); 
    }

    public function book()
    {
        return $this->hasMany('App\Book');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
