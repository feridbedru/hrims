<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\LicenseType;
use Illuminate\Http\Request;
use Exception;

class LicenseTypesController extends Controller
{

    /**
     * Display a listing of the license types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $licenseTypes = LicenseType::paginate(25);

        return view('settings.license_types.index', compact('licenseTypes'));
    }

    /**
     * Show the form for creating a new license type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.license_types.create');
    }

    /**
     * Store a new license type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            LicenseType::create($data);

            return redirect()->route('license_types.license_type.index')
                ->with('success_message', 'License Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified license type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $licenseType = LicenseType::findOrFail($id);
        

        return view('settings.license_types.edit', compact('licenseType'));
    }

    /**
     * Update the specified license type in the storage.
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
            
            $licenseType = LicenseType::findOrFail($id);
            $licenseType->update($data);

            return redirect()->route('license_types.license_type.index')
                ->with('success_message', 'License Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified license type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $licenseType = LicenseType::findOrFail($id);
            $licenseType->delete();

            return redirect()->route('license_types.license_type.index')
                ->with('success_message', 'License Type was successfully deleted.');
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
