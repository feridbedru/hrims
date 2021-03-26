<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLicense;
use App\Models\LicenseType;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeLicensesController extends Controller
{

    /**
     * Display a listing of the employee licenses.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeLicenses = EmployeeLicense::where('employee', $employee_id)->with('employees','types')->paginate(25);

        return view('employees.license.index', compact('employeeLicenses','employee'));
    }

    /**
     * Show the form for creating a new employee license.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $licenseTypes = LicenseType::pluck('name', 'id')->all();

        return view('employees.license.create', compact('employee', 'licenseTypes'));
    }

    /**
     * Store a new employee license in the storage.
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
            EmployeeLicense::create($data);

            return redirect()->route('employee_licenses.employee_license.index', $employee)
                ->with('success_message', 'Employee License was successfully added.');
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
     * Approve the specified employee license
     *
     * @param int $id
     */
    public function approve($employee, $employeeLicenses)
    {
        try {

            $employeeLicense = EmployeeLicense::findOrFail($employeeLicenses);
            $employeeLicense->status = 3;
            $employeeLicense->approved_by = 1;
            $employeeLicense->approved_at = now();
            $employeeLicense->save();

            return redirect()->route('employee_licenses.employee_license.index', $employee)
                ->with('success_message', 'Employee License was successfully approved.');
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
     * reject the specified employee license
     *
     * @param int $id
     */
    public function reject($employee, $employeeLicenses, Request $request)
    {
        try {

            $employeeLicense = EmployeeLicense::findOrFail($employeeLicenses);
            $employeeLicense->status = 2;
            $employeeLicense->note = $request['note'];
            $employeeLicense->save();

            return redirect()->route('employee_licenses.employee_license.index', $employee)
                ->with('success_message', 'Employee License was successfully rejected.');
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
     * Show the form for editing the specified employee license.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeLicenses)
    {
        $employee = Employee::findOrFail($employee);
        $employeeLicense = EmployeeLicense::findOrFail($employeeLicenses);
        $licenseTypes = LicenseType::pluck('name', 'id')->all();

        return view('employees.license.edit', compact('employeeLicense', 'employee', 'licenseTypes'));
    }

        //Prints employee license
        public function print($employee)
        {
            $employee_id = $employee;
            $employee = Employee::findOrFail($employee_id);
            $employeeLicenses = EmployeeLicense::where('employee', $employee_id)->with('employees','types')->get();

            return view('employees.license.print', compact('employeeLicenses','employee'));
        }

    /**
     * Update the specified employee license in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeLicenses, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeLicense = EmployeeLicense::findOrFail($employeeLicenses);
            $data['employee'] = $employee;
            $employeeLicense->update($data);

            return redirect()->route('employee_licenses.employee_license.index', $employee)
                ->with('success_message', 'Employee License was successfully updated.');
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
     * Remove the specified employee license from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeLicenses)
    {
        try {
            $employeeLicense = EmployeeLicense::findOrFail($employeeLicenses);
            $employeeLicense->delete();

            return redirect()->route('employee_licenses.employee_license.index', $employee)
                ->with('success_message', 'Employee License was successfully deleted.');
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
            'title' => 'required|string|min:1|max:255',
            'type' => 'required',
            'issuing_organization' => 'required|string|min:1',
            'expiry_date' => 'nullable',
            'file' => ['file', 'nullable'],
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
            'note' => 'string|min:1|max:1000|nullable',
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

        if (!file_exists('uploads/license'))
        {
            mkdir('uploads/license', 0777 , true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/license', $fileName);
        
        return $fileName;
    }
}
