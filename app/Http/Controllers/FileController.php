<?php

namespace App\Http\Controllers;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Validator;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = File::all();

        return response()->json($files);
    }

    public function store(Request $request)
    {

        $this->validateFile($request->all());        

        $this->validateFile($request);

        $newFile = File::create($request->all());

        return response()->json($newFile, 201);
    }


    public function storeMultiple(Request $request)
    {
        foreach ($request->files as $key => $file) {

            $this->validateFile($file);
        
        }

        $newFiles = File::insert($request->files);
        
        return response()->json($newFiles,201);
    }
    

    public function search($key)
    {
        $searchResults = File::where('filename', 'like', "%$key%")
            ->orWhere('description', 'like', "%$key%")
            ->get();

        return response()->json($searchResults);
    }

    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);

        $this->validateFile($request->all());

        $file->update($request->all());

        return response()->json($file);
    }

    public function destroy($id)
    {
        File::destroy($id);
    }

    public function restore($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();

        return response()->json($file);
    }

    public function filesCount()
    {
        $count = File::all()->count();

        return response()->json($count);
    }

    public function filesCountByDate($date)
    {
        $date = new Carbon($date);

        $count = File::whereDate('created_at', $date->toDateString())->count();

        return response()->json($count);
    }


    private function validateFile($file){

        Validator::make($file, [
            'user_id'       => 'required',
            'url'           => 'required',
            'filename'      => 'required|min:1|max:255',
            'description'   => 'required|min:1|max:255',
            'mimetype'      => 'required',
            'category_id'   => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
        ])->validate();

    }

}
