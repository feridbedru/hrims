<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\DisabilityType;
use Illuminate\Http\Request;
use Exception;

class DisabilityTypesController extends Controller
{

    /**
     * Display a listing of the disability types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $disabilityTypes = DisabilityType::paginate(25);

        return view('settings.disability_types.index', compact('disabilityTypes'));
    }

    /**
     * Show the form for creating a new disability type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.disability_types.create');
    }

    /**
     * Store a new disability type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            DisabilityType::create($data);

            return redirect()->route('disability_types.disability_type.index')
                ->with('success_message', 'Disability Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified disability type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $disabilityType = DisabilityType::findOrFail($id);
        

        return view('settings.disability_types.edit', compact('disabilityType'));
    }

    /**
     * Update the specified disability type in the storage.
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
            
            $disabilityType = DisabilityType::findOrFail($id);
            $disabilityType->update($data);

            return redirect()->route('disability_types.disability_type.index')
                ->with('success_message', 'Disability Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified disability type from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $disabilityType = DisabilityType::findOrFail($id);
            $delete = $disabilityType->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Disability Type deleted successfully";
            } else {
                $success = false;
                $message = "Disability Type not found";
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
