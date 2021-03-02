<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\CertificationVendor;
use App\Models\Employee;
use App\Models\EmployeeCertification;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;

class EmployeeCertificationsController extends Controller
{

    /**
     * Display a listing of the employee certifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeCertifications = DB::table('employee_certifications')
                                ->join('employees','employee_certifications.employee','=','employees.id')
                                ->join('skill_categories','employee_certifications.category','=','skill_categories.id')
                                ->join('certification_vendors','employee_certifications.vendor','=','certification_vendors.id')
                                ->select('employee_certifications.*','employees.en_name','skill_categories.name as category','certification_vendors.name as vendor')
                                ->paginate(25);

        return view('employees.certification.index', compact('employeeCertifications'));
    }

    /**
     * Show the form for creating a new employee certification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
$skillCategories = SkillCategory::pluck('name','id')->all();
$certificationVendors = CertificationVendor::pluck('name','id')->all();
$creators = User::pluck('name','id')->all();
$approvedBies = User::pluck('name','id')->all();
        
        return view('employees.certification.create', compact('employees','skillCategories','certificationVendors','creators','approvedBies'));
    }

    /**
     * Store a new employee certification in the storage.
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
            EmployeeCertification::create($data);

            return redirect()->route('employee_certifications.employee_certification.index')
                ->with('success_message', 'Employee Certification was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee certification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeCertification = EmployeeCertification::with('employee','skillcategory','certificationvendor','creator','approvedby')->findOrFail($id);

        return view('employees.certification.show', compact('employeeCertification'));
    }

    /**
     * Show the form for editing the specified employee certification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeCertification = EmployeeCertification::findOrFail($id);
        $employees = Employee::pluck('en_name','id')->all();
        $skillCategories = SkillCategory::pluck('name','id')->all();
        $certificationVendors = CertificationVendor::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('name','id')->all();

        return view('employees.certification.edit', compact('employeeCertification','employees','skillCategories','certificationVendors','creators','approvedBies'));
    }

    /**
     * Update the specified employee certification in the storage.
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
            
            $employeeCertification = EmployeeCertification::findOrFail($id);
            $employeeCertification->update($data);

            return redirect()->route('employee_certifications.employee_certification.index')
                ->with('success_message', 'Employee Certification was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee certification from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeCertification = EmployeeCertification::findOrFail($id);
            $employeeCertification->delete();

            return redirect()->route('employee_certifications.employee_certification.index')
                ->with('success_message', 'Employee Certification was successfully deleted.');
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
            'name' => 'required|string|min:1|max:255',
            'issued_on' => 'required|string|min:1',
            'certification_number' => 'string|min:1|nullable',
            'category' => 'required',
            'verification_link' => 'string|min:1|nullable',
            'vendor' => 'nullable',
            'attachment' => ['file','nullable'],
            'expires_on' => 'nullable|string|min:0',
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable|date_format:j/n/Y g:i A',
            'note' => 'string|min:1|max:1000|nullable', 
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
