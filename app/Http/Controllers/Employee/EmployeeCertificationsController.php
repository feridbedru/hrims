<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\CertificationVendor;
use App\Models\Employee;
use App\Models\EmployeeCertification;
use App\Models\SkillCategory;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeCertificationsController extends Controller
{

    /**
     * Display a listing of the employee certifications.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeCertifications = EmployeeCertification::where('employee', $employee_id)->with('employees', 'vendors', 'categories')->paginate(25);

        return view('employees.certification.index', compact('employeeCertifications', 'employee'));
    }

    /**
     * Show the form for creating a new employee certification.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $skillCategories = SkillCategory::pluck('name', 'id')->all();
        $certificationVendors = CertificationVendor::pluck('name', 'id')->all();

        return view('employees.certification.create', compact('employee', 'skillCategories', 'certificationVendors'));
    }

    /**
     * Store a new employee certification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request, $id)
    {
        try {

            $employee = Employee::findOrFail($id);
            $data = $this->getData($request);
            $data['created_by'] = Auth::Id();
            $data['status'] = 1;
            $data['employee'] = $id;
            if ('thisUserIsASuperAdmin') {
                $data['status'] = 3;
                $data['approved_by'] = Auth::Id();
                $data['approved_at'] = now();
            }
            EmployeeCertification::create($data);

            return redirect()->route('employee_certifications.employee_certification.index', $employee)
                ->with('success_message', 'Employee Certification was successfully added.');
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
     * Approve the specified employee certification
     *
     * @param int $id
     */
    public function approve($employee, $employeeEducations)
    {
        try {

            $employeeCertification = EmployeeCertification::findOrFail($employeeEducations);
            $employeeCertification->status = 3;
            $employeeCertification->approved_by = Auth::Id();
            $employeeCertification->approved_at = now();
            $employeeCertification->save();

            return redirect()->route('employee_certifications.employee_certification.show', ['employee' => $employee, 'employeeCertification' => $employeeCertification])
                ->with('success_message', 'Employee Education was successfully approved.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * reject the specified employee certification
     *
     * @param int $id
     */
    public function reject($employee, $employeeEducations, Request $request)
    {
        try {

            $employeeCertification = EmployeeCertification::findOrFail($employeeEducations);
            $employeeCertification->status = 2;
            $employeeCertification->note = $request['note'];
            $employeeCertification->save();

            return redirect()->route('employee_certifications.employee_certification.show', ['employee' => $employee, 'employeeCertification' => $employeeCertification])
                ->with('success_message', 'Employee Education was successfully rejected.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()
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
    public function show($employee, $employeeCertifications)
    {
        $employee = Employee::findOrFail($employee);
        $employeeCertification = EmployeeCertification::with('employees', 'vendors', 'categories')->findOrFail($employeeCertifications);

        return view('employees.certification.show', compact('employeeCertification', 'employee'));
    }

    /**
     * Show the form for editing the specified employee certification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeCertifications)
    {
        $employee = Employee::findOrFail($employee);
        $employeeCertification = EmployeeCertification::findOrFail($employeeCertifications);
        $skillCategories = SkillCategory::pluck('name', 'id')->all();
        $certificationVendors = CertificationVendor::pluck('name', 'id')->all();

        return view('employees.certification.edit', compact('employeeCertification', 'employee', 'skillCategories', 'certificationVendors'));
    }

    //Prints employee certification
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeCertifications = EmployeeCertification::where('employee', $employee_id)->with('employees', 'vendors', 'categories')->get();

        return view('employees.certification.print', compact('employeeCertifications', 'employee'));
    }

    /**
     * Update the specified employee certification in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeCertifications, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeCertification = EmployeeCertification::findOrFail($employeeCertifications);
            $data['employee'] = $employee;
            $employeeCertification->update($data);

            return redirect()->route('employee_certifications.employee_certification.index', $employee)
                ->with('success_message', 'Employee Certification was successfully updated.');
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
     * Remove the specified employee certification from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeCertifications)
    {
        try {
            $employeeCertification = EmployeeCertification::findOrFail($employeeCertifications);
            $employeeCertification->delete();

            return redirect()->route('employee_certifications.employee_certification.index', $employee)
                ->with('success_message', 'Employee Certification was successfully deleted.');
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
            'name' => 'required|string|min:1|max:255',
            'issued_on' => 'required|string|min:1',
            'certification_number' => 'string|min:1|nullable',
            'category' => 'required',
            'verification_link' => 'string|min:1|nullable',
            'vendor' => 'nullable',
            'attachment' => ['file', 'nullable'],
            'expires_on' => 'nullable|string|min:0',
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
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

        if (!file_exists('uploads/certification')) {
            mkdir('uploads/certification', 0777, true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/certification', $fileName);

        return $fileName;
    }
}
