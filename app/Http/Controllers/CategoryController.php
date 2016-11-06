<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::withCount('files')->paginate(10);

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $this->authorize('canUploadFiles');

        $this->validateCategory($request);

        $newCategory = Category::create($request->all());

        foreach ($request->fileArray as $file) {
            $file = auth()->user()->files()->create($file);
            $newCategory->files()->attach($file->id);
        }

        return response()->json($newCategory, 201);
    }

    public function storeFiles(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        foreach ($request->fileArray as $file) {
            $file = File::create($file);
            $category->files()->attach($file->id);
        }

        return response()->json($category->files, 200);
    }

    public function showFiles($id)
    {
        $categoryWithFiles = Category::with('files')->orderBy('created_at')->findOrFail($id);

        return response()->json($categoryWithFiles);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin');

        $category = Category::findOrFail($id);

        $this->validateCategory($request);

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy($id)
    {
        $this->authorize('admin');

        Category::destroy($id);
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->get();

        return response()->json($categories);
    }

    public function restore($id)
    {
        $this->authorize('admin');

        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return response()->json($category);
    }

    public function remove($id)
    {
        $this->authorize('admin');

        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return response()->json($category);
    }

    private function validateCategory(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:2|max:50',
        ]);

    }

}
