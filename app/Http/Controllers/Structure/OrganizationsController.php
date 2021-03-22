<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\OrganizationUnit;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
        return view('structure.organizations.index', compact('organizations'));
    }


    /**
     * Display a structure of the organizations.
     *
     * @return Illuminate\View\View
     */
    public function structure()
    {
        $roots = OrganizationUnit::where('is_root_unit','1')->get();
        $seconds = OrganizationUnit::where('parent','6')->get();
        $units = OrganizationUnit::get();
        $teams = OrganizationUnit::whereNotNull('reports_to')->get();
        return view('structure.organizations.structure', compact('roots','seconds','units','teams'));
    }

    /**
     * Show the form for creating a new organization.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {      
        return view('structure.organizations.create');
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
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
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

        return view('structure.organizations.show', compact('organization'));
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
        

        return view('structure.organizations.edit', compact('organization'));
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
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
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
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
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
                'phone_number' => 'numeric|nullable|min:9',
                'fax_number' => 'numeric|nullable|min:9',
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

        if (!file_exists('uploads/organization'))
        {
            mkdir('uploads/organization', 0777 , true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/organization', $fileName);
        
        return $fileName;
        
    }
}