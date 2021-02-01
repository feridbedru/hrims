<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\AddressType;
use Illuminate\Http\Request;
use Exception;

class AddressTypesController extends Controller
{

    /**
     * Display a listing of the address types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $addressTypes = AddressType::paginate(25);

        return view('settings.address_types.index', compact('addressTypes'));
    }

    /**
     * Show the form for creating a new address type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.address_types.create');
    }

    /**
     * Store a new address type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            AddressType::create($data);

            return redirect()->route('address_types.address_type.index')
                ->with('success_message', 'Address Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified address type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $addressType = AddressType::findOrFail($id);
        

        return view('settings.address_types.edit', compact('addressType'));
    }

    /**
     * Update the specified address type in the storage.
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
            
            $addressType = AddressType::findOrFail($id);
            $addressType->update($data);

            return redirect()->route('address_types.address_type.index')
                ->with('success_message', 'Address Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified address type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $addressType = AddressType::findOrFail($id);
            $addressType->delete();

            return redirect()->route('address_types.address_type.index')
                ->with('success_message', 'Address Type was successfully deleted.');
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
