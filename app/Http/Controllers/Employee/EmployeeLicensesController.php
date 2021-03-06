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
    public function index()
    {
        $employeeLicenses = EmployeeLicense::with('employees','types')->paginate(25);

        return view('employees.license.index', compact('employeeLicenses'));
    }

    /**
     * Show the form for creating a new employee license.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $licenseTypes = LicenseType::pluck('name', 'id')->all();

        return view('employees.license.create', compact('employees', 'licenseTypes'));
    }

    /**
     * Store a new employee license in the storage.
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
            EmployeeLicense::create($data);

            return redirect()->route('employee_licenses.employee_license.index')
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
    public function approve($id)
    {
        try {

            $employeeLicense = EmployeeLicense::findOrFail($id);
            $employeeLicense->status = 3;
            $employeeLicense->approved_by = 1;
            $employeeLicense->approved_at = now();
            $employeeLicense->save();

            return redirect()->route('employee_licenses.employee_license.index')
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
    public function reject($id, Request $request)
    {
        try {

            $employeeLicense = EmployeeLicense::findOrFail($id);
            $employeeLicense->status = 2;
            $employeeLicense->note = '1';
            $employeeLicense->save();

            return redirect()->route('employee_licenses.employee_license.index')
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
    public function edit($id)
    {
        $employeeLicense = EmployeeLicense::findOrFail($id);
        $employees = Employee::pluck('en_name', 'id')->all();
        $licenseTypes = LicenseType::pluck('name', 'id')->all();

        return view('employees.license.edit', compact('employeeLicense', 'employees', 'licenseTypes'));
    }

    /**
     * Update the specified employee license in the storage.
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

            $employeeLicense = EmployeeLicense::findOrFail($id);
            $employeeLicense->update($data);

            return redirect()->route('employee_licenses.employee_license.index')
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
    public function destroy($id)
    {
        try {
            $employeeLicense = EmployeeLicense::findOrFail($id);
            $employeeLicense->delete();

            return redirect()->route('employee_licenses.employee_license.index')
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
            'employee' => 'required',
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

        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
