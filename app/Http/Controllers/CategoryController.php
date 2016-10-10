<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
    

    public function store(Request $request)
    {
        $this->validateCategory($request);
        
        $newCategory = Category::create($request->all());

        return response()->json($newCategory,201);
    }


    public function showFiles($id)
    {
        $categoryWithFiles = Category::with('files')->findOrFail($id);

        return response()->json($categoryWithFiles);
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->validateCategory($request);

        $category->update($request->all());

        return response()->json($category);
    }


    public function destroy($id)
    {
        Category::destroy($id);
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->get();

        return response()->json($categories);
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return response()->json($category);
    }

    public function remove($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return response()->json($category);
    }


    private function validateCategory(Request $request){

         $this->validate($request, [
            'name' => 'required|min:2|max:50',
        ]);

    }

}
