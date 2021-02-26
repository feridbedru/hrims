<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\EducationalField;
use Illuminate\Http\Request;
use Exception;

class EducationalFieldsController extends Controller
{

    /**
     * Display a listing of the educational fields.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $educationalFields = EducationalField::paginate(25);

        return view('settings.educational_fields.index', compact('educationalFields'));
    }

    /**
     * Show the form for creating a new educational field.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.educational_fields.create');
    }

    /**
     * Store a new educational field in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            EducationalField::create($data);

            return redirect()->route('educational_fields.educational_field.index')
                ->with('success_message', 'Educational Field was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified educational field.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $educationalField = EducationalField::findOrFail($id);
        

        return view('settings.educational_fields.edit', compact('educationalField'));
    }

    /**
     * Update the specified educational field in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $educationalField = EducationalField::findOrFail($id);
            $educationalField->update($data);

            return redirect()->route('educational_fields.educational_field.index')
                ->with('success_message', 'Educational Field was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified educational field from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $educationalField = EducationalField::findOrFail($id);
            $delete = $educationalField->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Educational Field deleted successfully";
            } else {
                $success = false;
                $message = "Educational Field not found";
            }
                    //  return response
                    return response()->json([
                        'success' => $success,
                        'message' => $message,
                    ]);
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'name' => 'required|string|min:1|max:255',
            'description' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
