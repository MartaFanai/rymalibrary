<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'book_id','member_id','noOfDays', 'receiptNo', 'billDate'
    ];

    public function book()
    {
    	return $this->belongsTo('App\Book'); 
    }

    public function member()
    {
    	return $this->belongsTo('App\Members'); 
    }
}
