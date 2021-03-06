<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('admin');

        $departments = Department::all();

        return response()->json($departments);
    }

    public function store(Request $request)
    {
        $this->authorize('admin');

        $this->validateDepartment($request);

        $newDepartment = Department::create($request->all());

        return response()->json($newDepartment, 201);
    }

    public function showFiles($id)
    {
        $departmentWithFiles = Department::with('files')->findOrFail($id);

        $this->authorize('canViewFiles', $departmentWithFiles);

        return response()->json($departmentWithFiles);
    }

    public function showUsers($id)
    {
        $departmentWithUsers = Department::with('users.department')->findOrFail($id);

        $this->authorize('canViewFiles', $departmentWithUsers);

        return response()->json($departmentWithUsers);
    }

    public function departmentsCount()
    {
        
        $count = Department::all()->count();

        return response()->json($count);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin');

        $department = Department::findOrFail($id);

        $this->validateDepartment($request);

        $department->update($request->all());

        return response()->json($department);
    }

    public function destroy($id)
    {
        $this->authorize('admin');

        Department::destroy($id);
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('admin');

        Department::destroy($request->departments);
    }

    public function trashed()
    {
        $departments = Department::onlyTrashed()->get();

        return response()->json($departments);
    }

    public function restore($id)
    {
        $this->authorize('admin');

        $department = Department::onlyTrashed()->findOrFail($id);
        $department->restore();

        return response()->json($department);
    }

    public function remove($id)
    {
        $this->authorize('admin');

        $department = Department::onlyTrashed()->findOrFail($id);
        $department->forceDelete();

        return response()->json($department);
    }

    private function validateDepartment(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'code' => 'required|min:2|max:50',
        ]);

    }

}
