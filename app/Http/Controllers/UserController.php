<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('department')->get();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $this->authorize('admin');

        $this->validateUser($request);

        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        $newUser = User::create($data);

        return response()->json($newUser, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function showFiles($id)
    {
        $files = File::where('user_id', $id)->get();

        return response()->json($files);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin');

        $user = User::findOrFail($id);

        $this->validateUpdateUser($request, $id);

        if (isset($request->password)) {
            $request->password = bcrypt($request->password);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required_with:current_password|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json($user, 201);
    }

    public function destroy($id)
    {
        $this->authorize('admin');

        User::destroy($id);
    }

    public function destroyMultiple(Request $request)
    {
        $this->authorize('admin');

        User::destroy($request->users);
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->get();

        return response()->json($users);
    }

    public function restore($id)
    {
        $this->authorize('admin');

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return response()->json($user);
    }

    public function remove($id)
    {
        $this->authorize('admin');

        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return response()->json($user);
    }

    public function usersCount()
    {
        $user = User::all()->count();

        return response()->json($user);
    }

    public function toggleCanUploadFiles($user_id)
    {
        $this->authorize('admin');
        
        $user = User::findOrFail($user_id);
        $user->can_upload_files = !$user->can_upload_files;
        $user->save();

        return response()->json($user); 
    }

    private function validateUser(Request $request, $id = null)
    {

        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'id_number' => 'required|min:2|max:50|unique:users,id_number,' . $id,
            'gender' => 'required|in:male,female',
            'position' => 'required|min:2|max:50',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:8|confirmed',
            'type' => 'required|in:admin,faculty,staff,standard',
        ]);

    }

    private function validateUpdateUser(Request $request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'id_number' => 'required|min:2|max:50|unique:users,id_number,' . $id,
            'gender' => 'required|in:male,female',
            'position' => 'required|min:2|max:50',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|email|unique:users,email,' . $id,
            'type' => 'required|in:admin,faculty,staff,standard',
            'password' => 'required_with:current_password|confirmed',
        ]);
    }
}
