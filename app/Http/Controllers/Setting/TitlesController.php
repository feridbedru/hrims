<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Title;
use Illuminate\Http\Request;
use Exception;

class TitlesController extends Controller
{

    /**
     * Display a listing of the titles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $titles = Title::paginate(25);

        return view('settings.titles.index', compact('titles'));
    }

    /**
     * Show the form for creating a new title.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.titles.create');
    }

    /**
     * Store a new title in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Title::create($data);

            return redirect()->route('titles.title.index')
                ->with('success_message', 'Title was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified title.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $title = Title::findOrFail($id);
        

        return view('settings.titles.edit', compact('title'));
    }

    /**
     * Update the specified title in the storage.
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
            
            $title = Title::findOrFail($id);
            $title->update($data);

            return redirect()->route('titles.title.index')
                ->with('success_message', 'Title was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified title from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $title = Title::findOrFail($id);
            $title->delete();

            return redirect()->route('titles.title.index')
                ->with('success_message', 'Title was successfully deleted.');
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
                'en_title' => 'required|string|min:1',
            'am_title' => 'required|string|min:1', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
