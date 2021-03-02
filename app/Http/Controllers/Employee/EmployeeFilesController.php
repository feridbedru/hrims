<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class EmployeeFilesController extends Controller
{

    /**
     * Display a listing of the employee files.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeFiles = EmployeeFile::with('employee','creator')->paginate(25);

        return view('employees.file.index', compact('employeeFiles'));
    }

    /**
     * Show the form for creating a new employee file.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('title','id')->all();
$creators = User::pluck('name','id')->all();
        
        return view('employees.file.create', compact('employees','creators'));
    }

    /**
     * Store a new employee file in the storage.
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
            EmployeeFile::create($data);

            return redirect()->route('employee_files.employee_file.index')
                ->with('success_message', 'Employee File was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee file.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeFile = EmployeeFile::with('employee','creator')->findOrFail($id);

        return view('employees.file.show', compact('employeeFile'));
    }

    /**
     * Show the form for editing the specified employee file.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeFile = EmployeeFile::findOrFail($id);
        $employees = Employee::pluck('title','id')->all();
$creators = User::pluck('name','id')->all();

        return view('employees.file.edit', compact('employeeFile','employees','creators'));
    }

    /**
     * Update the specified employee file in the storage.
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
            
            $employeeFile = EmployeeFile::findOrFail($id);
            $employeeFile->update($data);

            return redirect()->route('employee_files.employee_file.index')
                ->with('success_message', 'Employee File was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee file from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeFile = EmployeeFile::findOrFail($id);
            $employeeFile->delete();

            return redirect()->route('employee_files.employee_file.index')
                ->with('success_message', 'Employee File was successfully deleted.');
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
                'employee' => 'required',
            'title' => 'required|string|min:1|max:255',
            'description' => 'string|min:1|max:1000|nullable',
            'attachment' => ['file','nullable'],
            'created_by' => 'nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_attachment')) {
            $data['attachment'] = null;
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $this->moveFile($request->file('attachment'));
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
