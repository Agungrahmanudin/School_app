<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Majors extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'concentrations',
        'kaprog',
        'image',
    ];
}
