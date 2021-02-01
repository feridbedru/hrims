<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Exception;

class OrganizationsController extends Controller
{

    /**
     * Display a listing of the organizations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $organizations = Organization::paginate(25);
        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new organization.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {      
        return view('organizations.create');
    }

    /**
     * Store a new organization in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Organization::create($data);

            return redirect()->route('organizations.organization.index')
                ->with('success_message', 'Organization was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified organization.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);

        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified organization.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        

        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified organization in the storage.
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
            
            $organization = Organization::findOrFail($id);
            $organization->update($data);

            return redirect()->route('organizations.organization.index')
                ->with('success_message', 'Organization was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified organization from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $organization = Organization::findOrFail($id);
            $organization->delete();

            return redirect()->route('organizations.organization.index')
                ->with('success_message', 'Organization was successfully deleted.');
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
                'en_name' => 'required|string|min:5',
                'am_name' => 'string|min:5|nullable',
                'motto' => 'string|min:10|nullable',
                'mission' => 'string|min:10|nullable',
                'vision' => 'string|min:10|nullable',
                'logo' => ['file','nullable'],
                'header' => ['file','nullable'],
                'footer' => ['file','nullable'],
                'address' => 'string|min:1|nullable',
                'website' => 'string|min:1|nullable',
                'email' => 'nullable',
                'phone_number' => 'numeric|nullable|string|min:0',
                'fax_number' => 'numeric|nullable|string|min:0',
                'po_box' => 'string|min:1|nullable', 
            ];

        
        $data = $request->validate($rules);

        if ($request->has('custom_delete_logo')) {
            $data['logo'] = null;
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->moveFile($request->file('logo'));
        }
        if ($request->has('custom_delete_header')) {
            $data['header'] = null;
        }
        if ($request->hasFile('header')) {
            $data['header'] = $this->moveFile($request->file('header'));
        }
        if ($request->has('custom_delete_footer')) {
            $data['footer'] = null;
        }
        if ($request->hasFile('footer')) {
            $data['footer'] = $this->moveFile($request->file('footer'));
        }



        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 15);
        
    }
}