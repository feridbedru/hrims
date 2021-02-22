<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDisaster;
use App\Models\EmployeeDisasterIndeminity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class EmployeeDisasterIndeminitiesController extends Controller
{

    /**
     * Display a listing of the employee disaster indeminities.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeDisasterIndeminities = EmployeeDisasterIndeminity::with('employeedisaster','creator')->paginate(25);

        return view('employee_disaster_indeminities.index', compact('employeeDisasterIndeminities'));
    }

    /**
     * Show the form for creating a new employee disaster indeminity.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employeeDisasters = EmployeeDisaster::pluck('occured_on','id')->all();
        $creators = User::pluck('name','id')->all();
        
        return view('employee_disaster_indeminities.create', compact('employeeDisasters','creators'));
    }

    /**
     * Store a new employee disaster indeminity in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['created_by'] = Auth::Id();
            EmployeeDisasterIndeminity::create($data);

            return redirect()->route('employee_disaster_indeminities.employee_disaster_indeminity.index')
                ->with('success_message', 'Employee Disaster Indeminity was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee disaster indeminity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeDisasterIndeminity = EmployeeDisasterIndeminity::with('employeedisaster','creator')->findOrFail($id);

        return view('employee_disaster_indeminities.show', compact('employeeDisasterIndeminity'));
    }

    /**
     * Show the form for editing the specified employee disaster indeminity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeDisasterIndeminity = EmployeeDisasterIndeminity::findOrFail($id);
        $employeeDisasters = EmployeeDisaster::pluck('approved_at','id')->all();
        $creators = User::pluck('name','id')->all();

        return view('employee_disaster_indeminities.edit', compact('employeeDisasterIndeminity','employeeDisasters','creators'));
    }

    /**
     * Update the specified employee disaster indeminity in the storage.
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
            
            $employeeDisasterIndeminity = EmployeeDisasterIndeminity::findOrFail($id);
            $employeeDisasterIndeminity->update($data);

            return redirect()->route('employee_disaster_indeminities.employee_disaster_indeminity.index')
                ->with('success_message', 'Employee Disaster Indeminity was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee disaster indeminity from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeDisasterIndeminity = EmployeeDisasterIndeminity::findOrFail($id);
            $employeeDisasterIndeminity->delete();

            return redirect()->route('employee_disaster_indeminities.employee_disaster_indeminity.index')
                ->with('success_message', 'Employee Disaster Indeminity was successfully deleted.');
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
                'disaster' => 'required',
                'title' => 'required|string|min:1|max:255',
                'description' => 'required|string|min:1|max:1000',
                'cost' => 'string|min:1|nullable',
                'file' => ['file','nullable'],
                'created_by' => 'nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = null;
        }
        if ($request->hasFile('file')) {
            $data['file'] = $this->moveFile($request->file('file'));
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
        
        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
