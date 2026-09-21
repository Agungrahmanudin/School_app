<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galleries extends Models
{
    protected $fillables = [
        'title',
        'description',
        'image',
    ];
}
