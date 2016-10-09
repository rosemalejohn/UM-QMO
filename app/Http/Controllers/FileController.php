<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\File;

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
        $this->validateFile($request);
        
        $newFile = File::create($request->all());

        return response()->json($newFile,201);
    }


    public function search($key)
    {
        $searchResults = File::where('filename','like',"%$key%")
            ->orWhere('description','like',"%$key%")
            ->get();

        return response()->json($searchResults);
    }

    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);

        $this->validateFile($request);

        $file->update($request->all());

        return response()->json($file);
    }


    public function destroy($id)
    {
        File::destroy($id);
    }


    private function validateFile(Request $request){

         $this->validate($request, [
            'user_id'       => 'required',
            'url'           => 'required',
            'filename'      => 'required|min:1|max:255',
            'description'   => 'required|min:1|max:255',
            'mimetype'      => 'required',
            'category_id'   => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
        ]);

    }

}