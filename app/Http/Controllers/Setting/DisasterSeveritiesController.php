<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\DisasterSeverity;
use Illuminate\Http\Request;
use Exception;

class DisasterSeveritiesController extends Controller
{

    /**
     * Display a listing of the disaster severities.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $disasterSeverities = DisasterSeverity::paginate(25);

        return view('settings.disaster_severities.index', compact('disasterSeverities'));
    }

    /**
     * Show the form for creating a new disaster severity.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.disaster_severities.create');
    }

    /**
     * Store a new disaster severity in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            DisasterSeverity::create($data);

            return redirect()->route('disaster_severities.disaster_severity.index')
                ->with('success_message', 'Disaster Severity was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified disaster severity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $disasterSeverity = DisasterSeverity::findOrFail($id);
        

        return view('settings.disaster_severities.edit', compact('disasterSeverity'));
    }

    /**
     * Update the specified disaster severity in the storage.
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
            
            $disasterSeverity = DisasterSeverity::findOrFail($id);
            $disasterSeverity->update($data);

            return redirect()->route('disaster_severities.disaster_severity.index')
                ->with('success_message', 'Disaster Severity was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified disaster severity from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $disasterSeverity = DisasterSeverity::findOrFail($id);
            $delete = $disasterSeverity->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Disaster Severity deleted successfully";
            } else {
                $success = false;
                $message = "Disaster Severity not found";
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
