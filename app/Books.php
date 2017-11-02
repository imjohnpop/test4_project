<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'author_id',
        'user_id',
        'title',
        'published_at',
        'finished_reading_at',
        'my_review',
        'my_rating'
    ];

    protected $guarded = [
        'id'
    ];
}
