<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $fillable = [
        'filename', 'hash', 'start', 'queue', 'stop', 'process'
    ];
}
