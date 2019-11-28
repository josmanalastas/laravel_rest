<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $hidden = array('created_at', 'updated_at', 'product_id');
    /**
     * Get the propduct that owns the review.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
