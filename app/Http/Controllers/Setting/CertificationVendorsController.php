<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\CertificationVendor;
use Illuminate\Http\Request;
use Exception;

class CertificationVendorsController extends Controller
{

    /**
     * Display a listing of the certification vendors.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $certificationVendors = CertificationVendor::paginate(25);

        return view('settings.certification_vendors.index', compact('certificationVendors'));
    }

    /**
     * Show the form for creating a new certification vendor.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.certification_vendors.create');
    }

    /**
     * Store a new certification vendor in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            CertificationVendor::create($data);

            return redirect()->route('certification_vendors.certification_vendor.index')
                ->with('success_message', 'Certification Vendor was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified certification vendor.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $certificationVendor = CertificationVendor::findOrFail($id);
        

        return view('settings.certification_vendors.edit', compact('certificationVendor'));
    }

    /**
     * Update the specified certification vendor in the storage.
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
            
            $certificationVendor = CertificationVendor::findOrFail($id);
            $certificationVendor->update($data);

            return redirect()->route('certification_vendors.certification_vendor.index')
                ->with('success_message', 'Certification Vendor was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified certification vendor from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $certificationVendor = CertificationVendor::findOrFail($id);
            $certificationVendor->delete();

            return redirect()->route('certification_vendors.certification_vendor.index')
                ->with('success_message', 'Certification Vendor was successfully deleted.');
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
