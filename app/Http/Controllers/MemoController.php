<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $memos = Memo::with('user')->latest()->paginate(10);

        return response()->json($memos);
    }

    public function store(Request $request)
    {
        $this->authorize('admin');

        $this->validateMemo($request);

        $newMemo = Memo::create($request->all());

        return response()->json($newMemo->load('user'), 201);
    }

    public function show($id)
    {
        $memo = Memo::with('user')->findOrFail($id);

        return response()->json($memo);
    }

    public function showByUser($id)
    {
        $memo = Memo::with('user')->where('user_id', $id)->get();

        return response()->json($memo);
    }

    public function update(Request $request, $id)
    {
        $memo = Memo::findOrFail($id);

        $this->validateMemo($request);

        $memo->update($request->all());

        return response()->json($memo->load('user'));
    }

    public function destroy($id)
    {
        Memo::destroy($id);
    }

    public function destroyMultiple(Request $request)
    {
        Memo::destroy($request->memos);
    }

    public function trashed()
    {
        $memos = Memo::onlyTrashed()->get();

        return response()->json($memos);
    }

    public function restore($id)
    {
        $memo = Memo::onlyTrashed()->findOrFail($id);
        $memo->restore();

        return response()->json($memo);
    }

    public function remove($id)
    {
        $memo = Memo::onlyTrashed()->findOrFail($id);
        $memo->forceDelete();

        return response()->json($memo);
    }

    public function memosCount()
    {
        return response()->json(Memo::all()->count(), 200);
    }

    private function validateMemo(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:2|max:255',
            'body' => 'required|min:2',
        ]);

    }
}
