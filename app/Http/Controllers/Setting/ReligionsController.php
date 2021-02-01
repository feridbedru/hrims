<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;
use Exception;

class ReligionsController extends Controller
{

    /**
     * Display a listing of the religions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $religions = Religion::paginate(25);

        return view('settings.religions.index', compact('religions'));
    }

    /**
     * Show the form for creating a new religion.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.religions.create');
    }

    /**
     * Store a new religion in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Religion::create($data);

            return redirect()->route('religions.religion.index')
                ->with('success_message', 'Religion was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified religion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $religion = Religion::findOrFail($id);
        

        return view('settings.religions.edit', compact('religion'));
    }

    /**
     * Update the specified religion in the storage.
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
            
            $religion = Religion::findOrFail($id);
            $religion->update($data);

            return redirect()->route('religions.religion.index')
                ->with('success_message', 'Religion was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified religion from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $religion = Religion::findOrFail($id);
            $religion->delete();

            return redirect()->route('religions.religion.index')
                ->with('success_message', 'Religion was successfully deleted.');
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
