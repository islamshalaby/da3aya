<?php

namespace App\Http\Controllers\Admin\categories;

use App\Http\Controllers\Admin\AdminController;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Http\Request;
use App\SubFiveCategory;
use App\Category_user;
use App\Product;

class SubFiveCategoryController extends AdminController
{
    public function index()
    {

    }
    public function create($id)
    {
        $products = Product::where('sub_category_four_id',$id)->where('status',1)->where('deleted',0)->where('publish','Y')->get()->count();
        if($products > 0){
            session()->flash('danger', trans('messages.can_not_add_cat'));
            return back();
        }else{
            return view('admin.categories.sub_category.sub_two_category.sub_three_category.sub_four_category.sub_five_category.create',compact('id'));
        }
    }
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'sub_category_id' => 'required',
                'title_ar' => 'required',
                'title_en' => 'required',
                'image' => 'required',
            ]);
        $image_name = $request->file('image')->getRealPath();
        Cloudder::upload($image_name, null);
        $imagereturned = Cloudder::getResult();
        $image_id = $imagereturned['public_id'];
        $image_format = $imagereturned['format'];
        $image_new_name = $image_id.'.'.$image_format;
        $data['image'] = $image_new_name;
        $category = SubFiveCategory::create($data);
        if($request->users){
            $cat_user_data['cat_id'] = $category->id ;
            foreach ($request->users as $row){
                $cat_user_data['user_id'] = $row ;
                $cat_user_data['category_type'] = 4 ;
                Category_user::create($cat_user_data);
            }
        }
        session()->flash('success', trans('messages.added_s'));
        return redirect( route('sub_five_cat.show',$request->sub_category_id));
    }
    public function show($id)
    {
        $cat_id = $id;
        $data = SubFiveCategory::where('sub_category_id',$id)->where('deleted','0')->orderBy('sort' , 'asc')->get();
        return view('admin.categories.sub_category.sub_two_category.sub_three_category.sub_four_category.sub_five_category.index',compact('data','cat_id'));
    }
    public function change_is_show(Request $request){
        $data['is_show'] = $request->status ;
        SubFiveCategory::where('id', $request->id)->update($data);
        return 1;
    }
    // sorting
    public function sort(Request $request) {
        $post = $request->all();
        $count = 0;
        for ($i = 0; $i < count($post['id']); $i ++) :
            $index = $post['id'][$i];
            $home_section = SubFiveCategory::findOrFail($index);
            $count ++;
            $newPosition = $count;
            $data['sort'] = $newPosition;
            if($home_section->update($data)) {
                echo "success";
            }else {
                echo "failed";
            }
        endfor;
        exit('success');
    }

    public function edit($id) {
        $data = SubFiveCategory::where('id',$id)->first();
        return view('admin.categories.sub_category.sub_two_category.sub_three_category.sub_four_category.sub_five_category.edit', compact('data'));
    }
    public function update(Request $request, $id) {
        $model = SubFiveCategory::where('id',$id)->first();
        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required'
            ]);
        if($request->file('image')){
            $image = $model->image;
            $publicId = substr($image, 0 ,strrpos($image, "."));
            if($publicId != null ){
                Cloudder::delete($publicId);
            }
            $image_name = $request->file('image')->getRealPath();
            Cloudder::upload($image_name, null);
            $imagereturned = Cloudder::getResult();
            $image_id = $imagereturned['public_id'];
            $image_format = $imagereturned['format'];
            $image_new_name = $image_id.'.'.$image_format;
            $data['image'] = $image_new_name;
        }
        SubFiveCategory::where('id',$id)->update($data);
        session()->flash('success', trans('messages.updated_s'));
        return redirect( route('sub_five_cat.show',$model->sub_category_id));
    }
    public function destroy($id)
    {
        $data['deleted'] = "1";
        SubFiveCategory::where('id',$id)->update($data);
        session()->flash('success', trans('messages.deleted_s'));
        return back();
    }
}
