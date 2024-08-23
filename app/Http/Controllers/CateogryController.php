<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CateogryController extends Controller
{
    //  list
    public function list() {
        $categories = Category::orderby('created_at', 'desc')->get();
        return view('admin.category.list', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $this->categoryValidationCheck($request);

        Category::create(['name'=>$request->categoryTitle]);
        return redirect()->route('category.list')->with(['createSuccess'=>'Created Successfully!']);
    }

    public function edit($id) {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $this->categoryValidationCheck($request);
        Category::where('id', $id)->update(['name'=>$request->categoryTitle]);
        return redirect()->route('category.list')->with(['updateSuccess'=>'Updated Successfully!']);
    }


    public function delete($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return back();
    }

    private function categoryValidationCheck($request) {
        Validator::make($request->all(), [
            'categoryTitle' => 'required'
        ])->validate();
    }
}
