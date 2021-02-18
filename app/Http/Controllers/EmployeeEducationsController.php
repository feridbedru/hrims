<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use App\Models\EducationalField;
use App\Models\EducationalInstitute;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\GPAScale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class EmployeeEducationsController extends Controller
{

    /**
     * Display a listing of the employee educations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeEducations = EmployeeEducation::with('employee','educationlevel','educationalinstitute','educationalfield','gpascale','creator','approvedby')->paginate(25);

        return view('employee_educations.index', compact('employeeEducations'));
    }

    /**
     * Show the form for creating a new employee education.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $educationLevels = EducationLevel::pluck('name','id')->all();
        $educationalInstitutes = EducationalInstitute::pluck('name','id')->all();
        $educationalFields = EducationalField::pluck('name','id')->all();
        $gpaScales = GPAScale::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();
        
        return view('employee_educations.create', compact('employees','educationLevels','educationalInstitutes','educationalFields','gpaScales','creators','approvedBies'));
    }

    /**
     * Store a new employee education in the storage.
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
            EmployeeEducation::create($data);

            return redirect()->route('employee_educations.employee_education.index')
                ->with('success_message', 'Employee Education was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee education.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeEducation = EmployeeEducation::with('employee','educationlevel','educationalinstitute','educationalfield','gpascale','creator','approvedby')->findOrFail($id);

        return view('employee_educations.show', compact('employeeEducation'));
    }

    /**
     * Show the form for editing the specified employee education.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeEducation = EmployeeEducation::findOrFail($id);
        $employees = Employee::pluck('en_name','id')->all();
        $educationLevels = EducationLevel::pluck('name','id')->all();
        $educationalInstitutes = EducationalInstitute::pluck('name','id')->all();
        $educationalFields = EducationalField::pluck('name','id')->all();
        $gpaScales = GPAScale::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();

        return view('employee_educations.edit', compact('employeeEducation','employees','educationLevels','educationalInstitutes','educationalFields','gpaScales','creators','approvedBies'));
    }

    /**
     * Update the specified employee education in the storage.
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
            
            $employeeEducation = EmployeeEducation::findOrFail($id);
            $employeeEducation->update($data);

            return redirect()->route('employee_educations.employee_education.index')
                ->with('success_message', 'Employee Education was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee education from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeEducation = EmployeeEducation::findOrFail($id);
            $employeeEducation->delete();

            return redirect()->route('employee_educations.employee_education.index')
                ->with('success_message', 'Employee Education was successfully deleted.');
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
                'level' => 'required',
                'institute' => 'required',
                'field' => 'required',
                'gpa_scale' => 'required',
                'gpa' => 'required|string|min:1',
                'start_date' => 'nullable|date_format:j/n/Y g:i A',
                'end_date' => 'nullable|date_format:j/n/Y g:i A',
                'file' => ['file'],
                'has_coc' => 'boolean|nullable',
                'coc_issued_date' => 'nullable|date_format:j/n/Y g:i A',
                'coc_file' => ['file','nullable'],
                'status' => 'string|min:1|nullable',
                'created_by' => 'required',
                'approved_by' => 'nullable',
                'approved_at' => 'nullable|date_format:j/n/Y g:i A',
                'note' => 'string|min:1|max:1000|nullable', 
        ];
                if ($request->route()->getAction()['as'] == 'employee_educations.employeeeducation.store' || $request->has('custom_delete_file')) {
            array_push($rules['file'], 'required');
        }
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = '';
        }
        if ($request->hasFile('file')) {
            $data['file'] = $this->moveFile($request->file('file'));
        }
        if ($request->has('custom_delete_coc_file')) {
            $data['coc_file'] = null;
        }
        if ($request->hasFile('coc_file')) {
            $data['coc_file'] = $this->moveFile($request->file('coc_file'));
        }
        $data['has_coc'] = $request->has('has_coc');

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
