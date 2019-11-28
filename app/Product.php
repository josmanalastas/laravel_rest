<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $hidden = array('created_at', 'updated_at');

    /**
     * Get the reviews for the product
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
