<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table = 'mentor';

    public $timestamps = false;

    protected $fillable = [
        'user',
        'nama',
        'no_wa',
        'password',
    ];
}