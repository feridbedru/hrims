<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DisabilityType;
use App\Models\Employee;
use App\Models\EmployeeDisability;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class EmployeeDisabilitiesController extends Controller
{

    /**
     * Display a listing of the employee disabilities.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeDisabilities = EmployeeDisability::with('employee','disabilitytype','creator','approvedby')->paginate(25);

        return view('employees.disability.index', compact('employeeDisabilities'));
    }

    /**
     * Show the form for creating a new employee disability.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $disabilityTypes = DisabilityType::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();
        
        return view('employees.disability.create', compact('employees','disabilityTypes','creators','approvedBies'));
    }

    /**
     * Store a new employee disability in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['created_by'] = 1;
            $data['status'] = 1;
            EmployeeDisability::create($data);

            return redirect()->route('employee_disabilities.employee_disability.index')
                ->with('success_message', 'Employee Disability was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Approve the specified employee dsiability
     *
     * @param int $id
     */
    public function approve($id)
    {
        try {
            
            $employeeDisability = EmployeeDisability::findOrFail($id);
            $employeeDisability->status = '3';
            $employeeDisability->approved_by = '1';
            $employeeDisability->approved_at = now();
            $employeeDisability->save();

            return redirect()->route('employee_disabilities.employee_disability.index')
                ->with('success_message', 'Employee Disability was successfully approved.');
        } catch (Exception $exception) {

            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * reject the specified employee disability
     *
     * @param int $id
     */
    public function reject($id, Request $request)
    {
        try {
            
            $employeeDisability = EmployeeDisability::findOrFail($id);
            $employeeDisability->status = '2';
            $employeeDisability->note = '1';
            $employeeDisability->save();

            return redirect()->route('employee_disabilities.employee_disability.index')
                ->with('success_message', 'Employee Disability was successfully rejected.');
        } catch (Exception $exception) {

            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified employee disability.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeDisability = EmployeeDisability::findOrFail($id);
        $employees = Employee::pluck('title','id')->all();
        $disabilityTypes = DisabilityType::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();

        return view('employees.disability.edit', compact('employeeDisability','employees','disabilityTypes','creators','approvedBies'));
    }

    /**
     * Update the specified employee disability in the storage.
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
            
            $employeeDisability = EmployeeDisability::findOrFail($id);
            $employeeDisability->update($data);

            return redirect()->route('employee_disabilities.employee_disability.index')
                ->with('success_message', 'Employee Disability was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee disability from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeDisability = EmployeeDisability::findOrFail($id);
            $employeeDisability->delete();

            return redirect()->route('employee_disabilities.employee_disability.index')
                ->with('success_message', 'Employee Disability was successfully deleted.');
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
            'type' => 'required',
            'description' => 'string|min:1|max:1000|nullable',
            'medical_certificate' => ['file','nullable'],
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'date_format:j/n/Y g:i A|nullable',
            'note' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_medical_certificate')) {
            $data['medical_certificate'] = null;
        }
        if ($request->hasFile('medical_certificate')) {
            $data['medical_certificate'] = $this->moveFile($request->file('medical_certificate'));
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
