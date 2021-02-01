<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Relationship;
use Illuminate\Http\Request;
use Exception;

class RelationshipsController extends Controller
{

    /**
     * Display a listing of the relationships.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $relationships = Relationship::paginate(25);

        return view('settings.relationships.index', compact('relationships'));
    }

    /**
     * Show the form for creating a new relationship.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.relationships.create');
    }

    /**
     * Store a new relationship in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Relationship::create($data);

            return redirect()->route('relationships.relationship.index')
                ->with('success_message', 'Relationship was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified relationship.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $relationship = Relationship::findOrFail($id);
        

        return view('settings.relationships.edit', compact('relationship'));
    }

    /**
     * Update the specified relationship in the storage.
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
            
            $relationship = Relationship::findOrFail($id);
            $relationship->update($data);

            return redirect()->route('relationships.relationship.index')
                ->with('success_message', 'Relationship was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified relationship from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $relationship = Relationship::findOrFail($id);
            $relationship->delete();

            return redirect()->route('relationships.relationship.index')
                ->with('success_message', 'Relationship was successfully deleted.');
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
