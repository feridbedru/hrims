<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use App\Models\EducationalField;
use App\Models\EducationalInstitute;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\GPAScale;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeEducationsController extends Controller
{

    /**
     * Display a listing of the employee educations.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeEducations = EmployeeEducation::where('employee', $employee_id)->with('employees', 'levels', 'institutes', 'fields', 'gpaScales')->paginate(25);

        return view('employees.education.index', compact('employeeEducations', 'employee'));
    }

    /**
     * Show the form for creating a new employee education.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $educationLevels = EducationLevel::pluck('name', 'id')->all();
        $educationalInstitutes = EducationalInstitute::pluck('name', 'id')->all();
        $educationalFields = EducationalField::pluck('name', 'id')->all();
        $gpaScales = GPAScale::pluck('name', 'id')->all();

        return view('employees.education.create', compact('employee', 'educationLevels', 'educationalInstitutes', 'educationalFields', 'gpaScales'));
    }

    /**
     * Store a new employee education in the storage.
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
            EmployeeEducation::create($data);

            return redirect()->route('employee_educations.employee_education.index', $employee)
                ->with('success_message', 'Employee Education was successfully added.');
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
     * Approve the specified employee education
     *
     * @param int $id
     */
    public function approve($employee, $employeeEducations)
    {
        try {

            $employeeEducation = EmployeeEducation::findOrFail($employeeEducations);
            $employeeEducation->status = 3;
            $employeeEducation->approved_by = Auth::Id();
            $employeeEducation->approved_at = now();
            $employeeEducation->save();

            return redirect()->route('employee_educations.employee_education.show', ['employee' => $employee, 'employeeEducation' => $employeeEducation])
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
     * reject the specified employee education
     *
     * @param int $id
     */
    public function reject($employee, $employeeEducations, Request $request)
    {
        try {

            $employeeEducation = EmployeeEducation::findOrFail($employeeEducations);
            $employeeEducation->status = 2;
            $employeeEducation->note = $request['note'];
            $employeeEducation->save();

            return redirect()->route('employee_educations.employee_education.show', ['employee' => $employee, 'employeeEducation' => $employeeEducation])
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
     * Display the specified employee education.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($employee, $employeeEducations)
    {
        $employee = Employee::findOrFail($employee);
        $employeeEducation = EmployeeEducation::with('employees', 'levels', 'institutes', 'fields', 'gpaScales')->findOrFail($employeeEducations);

        return view('employees.education.show', compact('employeeEducation', 'employee'));
    }

    /**
     * Show the form for editing the specified employee education.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeEducations)
    {
        $employee = Employee::findOrFail($employee);
        $employeeEducation = EmployeeEducation::findOrFail($employeeEducations);
        $educationLevels = EducationLevel::pluck('name', 'id')->all();
        $educationalInstitutes = EducationalInstitute::pluck('name', 'id')->all();
        $educationalFields = EducationalField::pluck('name', 'id')->all();
        $gpaScales = GPAScale::pluck('name', 'id')->all();

        return view('employees.education.edit', compact('employeeEducation', 'employee', 'educationLevels', 'educationalInstitutes', 'educationalFields', 'gpaScales'));
    }

    //Prints employee education
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeEducations = EmployeeEducation::where('employee', $employee_id)->with('employees', 'levels', 'institutes', 'fields', 'gpaScales')->paginate(25);

        return view('employees.education.print', compact('employeeEducations', 'employee'));
    }

    /**
     * Update the specified employee education in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeEducations, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeEducation = EmployeeEducation::findOrFail($employeeEducations);
            $data['employee'] = $employee;
            $employeeEducation->update($data);

            return redirect()->route('employee_educations.employee_education.index', $employee)
                ->with('success_message', 'Employee Education was successfully updated.');
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
     * Remove the specified employee education from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeEducations)
    {
        try {
            $employeeEducation = EmployeeEducation::findOrFail($employeeEducations);
            $employeeEducation->delete();

            return redirect()->route('employee_educations.employee_education.index', $employee)
                ->with('success_message', 'Employee Education was successfully deleted.');
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
            'level' => 'required',
            'institute' => 'required',
            'field' => 'required',
            'gpa_scale' => 'required',
            'gpa' => 'required|string|min:1',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'file' => ['file'],
            'has_coc' => 'boolean|nullable',
            'coc_issued_date' => 'nullable',
            'coc_file' => ['file', 'nullable'],
            'status' => 'string|min:1|nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
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

        if (!file_exists('uploads/education')) {
            mkdir('uploads/education', 0777, true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/education', $fileName);

        return $fileName;
    }
}
