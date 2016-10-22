<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{

    public function index()
    {
        $this->authorize('admin');

        $requestForms = RequestForm::all();

        return response()->json($requestForms);
    }

    public function store(Request $request)
    {
        $this->validateRequestForm($request);

        $newRequestForm = RequestForm::create($request->all());

        return response()->json($newRequestForm, 201);
    }

    public function show($id)
    {
        $requestForm = RequestForm::findOrFail($id);

        return response()->json($requestForm);
    }

    public function showDone()
    {
        $this->authorize('admin');

        $requestForms = RequestForm::where('is_done', 1)->get();

        return response()->json($requestForms);
    }

    public function showUndone()
    {
        $this->authorize('admin');

        $requestForms = RequestForm::where('is_done', 0)->get();

        return response()->json($requestForms);
    }

    public function done($id)
    {
        $this->authorize('admin');

        $requestForm = RequestForm::findOrFail($id);
        $requestForm->is_done = 1;
        $requestForm->save();

        return response()->json($requestForm);
    }

    public function undone($id)
    {
        $this->authorize('admin');

        $requestForm = RequestForm::findOrFail($id);
        $requestForm->is_done = 0;
        $requestForm->save();

        return response()->json($requestForm);
    }

    public function update(Request $request, $id)
    {
        $requestForm = RequestForm::findOrFail($id);

        $this->validateRequestForm($request);

        $requestForm->update($request->all());

        return response()->json($requestForm);
    }

    public function destroy($id)
    {
        $this->authorize('admin');

        RequestForm::destroy($id);
    }

    public function restore($id)
    {
        $this->authorize('admin');

        $requestForm = RequestForm::onlyTrashed()->findOrFail($id);
        $requestForm->restore();

        return response()->json($requestForm);
    }

    public function remove($id)
    {
        $this->authorize('admin');

        $requestForm = RequestForm::onlyTrashed()->findOrFail($id);
        $requestForm->forceDelete();

        return response()->json($requestForm);
    }

    public function approveMultiple(Request $request)
    {
        $this->authorize('admin');

        foreach ($request->requests as $requestID) {
            $requestForm = RequestForm::find($requestID);
            $requestForm->is_done = true;
            $requestForm->save();
            // send text message to contact number
            // Hi {name}, this is to inform you that your request for {request_for} is already approved. Please go to the office and process.
        }
    }

    private function validateRequestForm(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'college' => 'required|min:2|max:255',
            'school_year' => 'required|min:4|max:4',
            'email' => 'email',
            'contact_number' => 'required|min:11|max:12',
            'request_for' => 'required|min:2|max:255',
        ]);

    }
}
