<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_option extends Model
{
    protected $fillable = ['title_ar','image', 'title_en', 'cat_id','deleted','is_required', 'category_type', 'cat_type'];

    public function Values() {
        return $this->hasMany('App\Category_option_value', 'option_id');
    }
}
