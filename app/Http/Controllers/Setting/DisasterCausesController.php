<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\DisasterCause;
use Illuminate\Http\Request;
use Exception;

class DisasterCausesController extends Controller
{

    /**
     * Display a listing of the disaster causes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $disasterCauses = DisasterCause::paginate(25);

        return view('settings.disaster_causes.index', compact('disasterCauses'));
    }

    /**
     * Show the form for creating a new disaster cause.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.disaster_causes.create');
    }

    /**
     * Store a new disaster cause in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            DisasterCause::create($data);

            return redirect()->route('disaster_causes.disaster_cause.index')
                ->with('success_message', 'Disaster Cause was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified disaster cause.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $disasterCause = DisasterCause::findOrFail($id);
        

        return view('settings.disaster_causes.edit', compact('disasterCause'));
    }

    /**
     * Update the specified disaster cause in the storage.
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
            
            $disasterCause = DisasterCause::findOrFail($id);
            $disasterCause->update($data);

            return redirect()->route('disaster_causes.disaster_cause.index')
                ->with('success_message', 'Disaster Cause was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified disaster cause from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $disasterCause = DisasterCause::findOrFail($id);
            $disasterCause->delete();

            return redirect()->route('disaster_causes.disaster_cause.index')
                ->with('success_message', 'Disaster Cause was successfully deleted.');
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
