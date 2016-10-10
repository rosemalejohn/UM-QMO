<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Department;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $departments = Department::all();

        return response()->json($departments);
    }
    

    public function store(Request $request)
    {
        $this->validateDepartment($request);
        
        $newDepartment = Department::create($request->all());

        return response()->json($newDepartment,201);
    }


    public function showFiles($id)
    {
        $departmentWithFiles = Department::with('files')->findOrFail($id);

        return response()->json($departmentWithFiles);
    }

    public function showUsers($id)
    {
        $departmentWithUsers = Department::with('users')->findOrFail($id);

        return response()->json($departmentWithUsers);
    }


    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $this->validateDepartment($request);

        $department->update($request->all());

        return response()->json($department);
    }


    public function destroy($id)
    {
        Department::destroy($id);
    }

    public function destroyMultiple(Request $request)
    {
        Department::destroy($request->departments);
    }

    public function trashed()
    {
        $departments = Department::onlyTrashed()->get();

        return response()->json($departments);
    }

    public function restore($id)
    {
        $department = Department::onlyTrashed()->findOrFail($id);
        $department->restore();

        return response()->json($department);
    }


    private function validateDepartment(Request $request){

         $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'code' => 'required|min:2|max:50',
        ]);

    }

}

