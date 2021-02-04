<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Sex;
use Illuminate\Http\Request;
use Exception;

class SexesController extends Controller
{

    /**
     * Display a listing of the sexes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $sexes = Sex::paginate(25);

        return view('settings.sexes.index', compact('sexes'));
    }

    /**
     * Show the form for creating a new sex.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.sexes.create');
    }

    /**
     * Store a new sex in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Sex::create($data);

            return redirect()->route('sexes.sex.index')
                ->with('success_message', 'Sex was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified sex.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sex = Sex::findOrFail($id);
        

        return view('settings.sexes.edit', compact('sex'));
    }

    /**
     * Update the specified sex in the storage.
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
            
            $sex = Sex::findOrFail($id);
            $sex->update($data);

            return redirect()->route('sexes.sex.index')
                ->with('success_message', 'Sex was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified sex from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sex = Sex::findOrFail($id);
            $sex->delete();

            return redirect()->route('sexes.sex.index')
                ->with('success_message', 'Sex was successfully deleted.');
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
