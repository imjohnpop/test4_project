<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'year_of_birth'
    ];

    protected $guarded = [
        'id'
    ];
}
