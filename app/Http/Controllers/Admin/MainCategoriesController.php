<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    public function AllMainCategories(){
        $categories = Category::parent()->paginate(PAGINATION_COUNT);

        return view('admin.categories.index', compact('categories'));
    }

    public function edit($id){
        $category = Category::find($id);

        if(!$category)
            return redirect()->route('admin.mainCategories')->with(['error' => 'Category not found']);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request){
        try {
        $Category = Category::find($request -> id);

        $Category->updateOrCreate(['id' => $request -> id], [
            'slug' => $request -> slug,
        ])->createTranslation($request);

            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);
        }catch (\Exception $ex){
            return redirect() -> back() -> with(['error' => 'حدث خطأ ما!']);
            DB::rollBack();
        }
    }
}
