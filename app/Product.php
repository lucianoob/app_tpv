<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id', 'category', 'name', 'free_shipping', 'description', 'price'
    ];
}
