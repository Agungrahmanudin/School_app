<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurriculars extends Model
{
    protected $fillable = [
        'names',
        'descriptions',
        'activitiess',
        'images',
        'coachs',
        'schedules',
    ];
}
