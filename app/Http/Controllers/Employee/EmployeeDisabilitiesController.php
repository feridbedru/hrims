<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DisabilityType;
use App\Models\Employee;
use App\Models\EmployeeDisability;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeDisabilitiesController extends Controller
{

    /**
     * Display a listing of the employee disabilities.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeDisabilities = EmployeeDisability::where('employee', $employee_id)->with('employees', 'types')->paginate(25);

        return view('employees.disability.index', compact('employeeDisabilities','employee'));
    }

    /**
     * Show the form for creating a new employee disability.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $disabilityTypes = DisabilityType::pluck('name', 'id')->all();

        return view('employees.disability.create', compact('employee', 'disabilityTypes'));
    }

    /**
     * Store a new employee disability in the storage.
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
            $data['created_by'] = 1;
            $data['status'] = 1;
            $data['employee'] = $id;
            EmployeeDisability::create($data);

            return redirect()->route('employee_disabilities.employee_disability.index', $employee)
                ->with('success_message', 'Employee Disability was successfully added.');
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
     * Approve the specified employee dsiability
     *
     * @param int $id
     */
    public function approve($employee, $employeeDisabilities)
    {
        try {

            $employeeDisability = EmployeeDisability::findOrFail($employeeDisabilities);
            $employeeDisability->status = 3;
            $employeeDisability->approved_by = 1;
            $employeeDisability->approved_at = now();
            $employeeDisability->save();

            return redirect()->route('employee_disabilities.employee_disability.index', $employee)
                ->with('success_message', 'Employee Disability was successfully approved.');
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
     * reject the specified employee disability
     *
     * @param int $id
     */
    public function reject($employee, $employeeDisabilities, Request $request)
    {
        try {

            $employeeDisability = EmployeeDisability::findOrFail($employeeDisabilities);
            $employeeDisability->status = 2;
            $employeeDisability->note = $request['note'];
            $employeeDisability->save();

            return redirect()->route('employee_disabilities.employee_disability.index',$employee)
                ->with('success_message', 'Employee Disability was successfully rejected.');
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
     * Show the form for editing the specified employee disability.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeDisabilities)
    {
        $employee = Employee::findOrFail($employee);
        $employeeDisability = EmployeeDisability::findOrFail($employeeDisabilities);
        $disabilityTypes = DisabilityType::pluck('name', 'id')->all();

        return view('employees.disability.edit', compact('employeeDisability', 'employee', 'disabilityTypes'));
    }

    /**
     * Update the specified employee disability in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeDisabilities, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeDisability = EmployeeDisability::findOrFail($employeeDisabilities);
            $data['employee'] = $employee;
            $employeeDisability->update($data);

            return redirect()->route('employee_disabilities.employee_disability.index',$employee)
                ->with('success_message', 'Employee Disability was successfully updated.');
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
     * Remove the specified employee disability from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeDisabilities)
    {
        try {
            $employeeDisability = EmployeeDisability::findOrFail($employeeDisabilities);
            $employeeDisability->delete();

            return redirect()->route('employee_disabilities.employee_disability.index',$employee)
                ->with('success_message', 'Employee Disability was successfully deleted.');
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
            'type' => 'required',
            'description' => 'string|min:1|max:1000|nullable',
            'medical_certificate' => ['file', 'nullable'],
            'status' => 'numeric|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
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

        if (!file_exists('uploads/disability'))
        {
            mkdir('uploads/disability', 0777 , true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/disability', $fileName);
        
        return $fileName;
    }
}
