<?php
namespace App\Http\Controllers\Admin\categories;

use App\Http\Controllers\Admin\AdminController;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Http\Request;
use App\Category_option;

class CategoryOptionsController extends AdminController{
    public function index()
    {
    }

    public function show($id){
        $data = Category_option::where('deleted','0')->where('cat_id',$id)->get();
        return view('admin.categories.category_options.index',compact('data','id'));
    }

    public function edit($id){
        $data = Category_option::find($id);
        return view('admin.categories.category_options.edit',compact('data','id'));
    }

    // get category options in all levels
    public function getCategoryOptions(Request $request) {
        $data = Category_option::where('deleted','0')->where('cat_id',$request->id)->where('category_type', $request->type)->get();
        $id = $request->id;
        $type = $request->type;
        return view('admin.categories.category_options.index',compact('data','id', 'type'));
    }

    public function store(Request $request){
        $data = $this->validate(\request(),
            [
                'cat_id' => 'required',
                'image' => 'required',
                'title_ar' => 'required',
                'title_en' => 'required',
                'is_required' => 'required',
                'category_type' => 'required'
            ]);

        $image_name = $request->file('image')->getRealPath();
        Cloudder::upload($image_name, null);
        $imagereturned = Cloudder::getResult();
        $image_id = $imagereturned['public_id'];
        $image_format = $imagereturned['format'];
        $image_new_name = $image_id.'.'.$image_format;
        $data['image'] = $image_new_name ;
        if ($data['category_type'] != 0) {
            $data['cat_type'] = 'subcategory';
        }
        Category_option::create($data);
        session()->flash('success', trans('messages.added_s'));
        return back();
    }

    public function update(Request $request){
        $data = $this->validate(\request(),
            [
                'option_id' => 'required',
                'title_ar' => 'required',
                'title_en' => 'required',
                'is_required' => 'required'
            ]);

        if($request->image != null){
            $image_name = $request->file('image')->getRealPath();
            Cloudder::upload($image_name, null);
            $imagereturned = Cloudder::getResult();
            $image_id = $imagereturned['public_id'];
            $image_format = $imagereturned['format'];
            $image_new_name = $image_id.'.'.$image_format;
            $data['image'] = $image_new_name ;
        }else{
            unset($data['image']);
        }
        unset($data['option_id']);
        Category_option::where('id',$request->option_id)->update($data);
        $option = Category_option::find($request->option_id);
        session()->flash('success', trans('messages.updated_s'));
        return redirect(route('cat_options.levels',[$option->cat_id, $option->category_type]));
    }

    public function destroy($id){
        $data['deleted'] = '1';
        Category_option::where('id',$id)->update($data);
        session()->flash('success', trans('messages.deleted_s'));
        return back();
    }
}
