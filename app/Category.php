<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $fillable = ['image', 'title_en', 'title_ar', 'deleted','offers_image','sort','is_show','create_show'];
    public function products() {
        return $this->hasMany('App\Product', 'category_id')->where('status', 1)->where('publish', 'Y')->where('deleted', 0);
    }
    public function SubCategories() {
        return $this->hasMany('App\SubCategory', 'category_id')->where('deleted', 0)->where('is_show', 1);
    }
    public function Category_users() {
        return $this->belongsToMany(User::class, 'category_users', 'cat_id', 'user_id')
            ->where('category_type',0);
    }
    public function Sub_categories() {
        $lang = session('lang_api');
        return $this->hasMany('App\SubCategory', 'category_id')
            ->select('id', 'title_'.$lang.' as title','category_id','image')
            ->where('deleted',0)->where('is_show', 1)->orderBy('sort','asc');
    }
    public function Category_ads() {
        return $this->hasMany('App\Categories_ad', 'cat_id')->select('image', 'cat_id','type','ad_type' ,'content')->where('type','category')->where('deleted','0');
    }

    public function Offers() {
        $user = auth()->user();
        return $this->hasMany('App\Product', 'category_id')->select('id','title','main_image as image','price','category_id','created_at')->where('offer', 1)
            ->where('status', 1)
            ->where('deleted', 0)
            ->where('publish', 'Y');
    }
}
