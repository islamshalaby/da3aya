<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubFiveCategory extends Model
{
    protected  $appends = ['next_level'];
    protected  $hidden = ['SubCategories'];
    protected $fillable = ['title_en', 'title_ar', 'image', 'deleted', 'sub_category_id','sort','is_show'];


    public function Category() {
        return $this->belongsTo('App\SubFourCategory', 'sub_category_id')->where('is_show', 1);
    }

    public function Category_users() {
        return $this->belongsToMany(User::class, 'category_users', 'cat_id', 'user_id')
            ->where('category_type',5);
    }

    public function products() {
        return $this->hasMany('App\Product', 'sub_category_five_id')->where('status', 1)->where('publish', 'Y')->where('deleted', 0);
    }


    public function getNextLevelAttribute(){

        return false ;
    }
}
