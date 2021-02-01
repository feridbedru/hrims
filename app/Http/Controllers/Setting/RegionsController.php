<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Exception;

class RegionsController extends Controller
{

    /**
     * Display a listing of the regions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $regions = Region::paginate(25);

        return view('settings.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new region.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.regions.create');
    }

    /**
     * Store a new region in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Region::create($data);

            return redirect()->route('regions.region.index')
                ->with('success_message', 'Region was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified region.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $region = Region::findOrFail($id);

        return view('settings.regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified region.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $region = Region::findOrFail($id);
        

        return view('settings.regions.edit', compact('region'));
    }

    /**
     * Update the specified region in the storage.
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
            
            $region = Region::findOrFail($id);
            $region->update($data);

            return redirect()->route('regions.region.index')
                ->with('success_message', 'Region was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified region from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $region = Region::findOrFail($id);
            $region->delete();

            return redirect()->route('regions.region.index')
                ->with('success_message', 'Region was successfully deleted.');
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
            'code' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
