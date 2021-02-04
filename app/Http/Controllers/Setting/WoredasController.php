<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Woreda;
use App\Models\Zone;
use Illuminate\Http\Request;
use Exception;

class WoredasController extends Controller
{

    /**
     * Display a listing of the woredas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $woredas = Woreda::with('zone')->paginate(25);

        return view('settings.woredas.index', compact('woredas'));
    }

    /**
     * Show the form for creating a new woreda.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $zones = Zone::pluck('name','id')->all();
        
        return view('settings.woredas.create', compact('zones'));
    }

    /**
     * Store a new woreda in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Woreda::create($data);

            return redirect()->route('woredas.woreda.index')
                ->with('success_message', 'Woreda was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified woreda.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $woreda = Woreda::findOrFail($id);
        $zones = Zone::pluck('name','id')->all();

        return view('settings.woredas.edit', compact('woreda','zones'));
    }

    /**
     * Update the specified woreda in the storage.
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
            
            $woreda = Woreda::findOrFail($id);
            $woreda->update($data);

            return redirect()->route('woredas.woreda.index')
                ->with('success_message', 'Woreda was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified woreda from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $woreda = Woreda::findOrFail($id);
            $woreda->delete();

            return redirect()->route('woredas.woreda.index')
                ->with('success_message', 'Woreda was successfully deleted.');
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
            'zone' => 'required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}