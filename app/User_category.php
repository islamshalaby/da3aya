<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_category extends Model
{
    protected $fillable = [
        'user_id',
        'category_id'
    ];
}
