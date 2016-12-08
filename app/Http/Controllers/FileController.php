<?php

namespace App\Http\Controllers;

use App\Models\File;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use stdClass;
use Validator;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = File::paginate(10);

        return response()->json($files);
    }

    public function store(Request $request)
    {
        $this->authorize('canUploadFiles');

        $this->validateFile($request->all());

        $newFile = auth()->user()->files()->create($request->all());

        return response()->json($newFile, 201);
    }

    public function storeMultiple(Request $request)
    {
        $this->authorize('canUploadFiles');

        foreach ($request->fileArray as $key => $file) {

            $this->validateFile($file);

        }

        $newFiles = auth()->user()->files()->insert($request->fileArray);

        return response()->json($newFiles, 201);
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

        $this->authorize('canUpdateFiles', $file);

        $this->validateFile($request->all());

        $file->update($request->all());

        return response()->json($file);
    }

    public function destroy($id)
    {
        $this->authorize('admin');

        File::destroy($id);
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('admin');

        File::destroy($request->files);
    }

    public function trashed()
    {
        $files = File::onlyTrashed()->get();

        return response()->json($files);
    }

    public function restore($id)
    {
        $this->authorize('admin');

        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();

        return response()->json($file);
    }

    public function remove($id)
    {
        $this->authorize('admin');

        $file = File::onlyTrashed()->findOrFail($id);
        $file->forceDelete();

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

    public function report($year)
    {

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $results = [];

        foreach ($months as $key => $mon) {

            $stat = new stdClass;
            $stat->month = $mon;
            $stat->files = File::whereYear('created_at', $year)->whereMonth('created_at', $key + 1)->count();
            $stat->deleted = File::onlyTrashed()->whereYear('created_at', $year)->whereMonth('created_at', $key + 1)->count();

            array_push($results, $stat);

        }

        return response()->json($results);
    }

    public function excelReport()
    {

        Excel::create('File Report', function ($excel) {

            $excel->sheet('Report', function ($sheet) {

                $files = File::with('user', 'department')->get();

                $sheet->loadView('reports.file')->with(compact('files'));

            });

        })->download('xls');
    }

    private function validateFile($file)
    {

        Validator::make($file, [
            'user_id' => 'required',
            'url' => 'required',
            'filename' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:255',
            'mimetype' => 'required',
        ])->validate();

    }

}
