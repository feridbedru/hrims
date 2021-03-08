<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DisasterCause;
use App\Models\DisasterSeverity;
use App\Models\Employee;
use App\Models\EmployeeDisaster;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeDisastersController extends Controller
{

    /**
     * Display a listing of the employee disasters.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeDisasters = EmployeeDisaster::where('employee', $employee_id)->with('causes','employees','severities')->paginate(25);

        return view('employees.disaster.index', compact('employeeDisasters','employee'));
    }

    /**
     * Show the form for creating a new employee disaster.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $disasterCauses = DisasterCause::pluck('name', 'id')->all();
        $disasterSeverities = DisasterSeverity::pluck('name', 'id')->all();

        return view('employees.disaster.create', compact('employee', 'disasterCauses', 'disasterSeverities'));
    }

    /**
     * Store a new employee disaster in the storage.
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
            $data['status'] = 1;
            $data['created_by'] = 1;
            $data['employee'] = $id;
            EmployeeDisaster::create($data);

            return redirect()->route('employee_disasters.employee_disaster.index',$employee)
                ->with('success_message', 'Employee Disaster was successfully added.');
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
     * Display the specified employee disaster.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($employee,$employeeDisasters)
    {
        $employee = Employee::findOrFail($employee);
        $employeeDisaster = EmployeeDisaster::with('causes','employees','severities')->findOrFail($employeeDisasters);

        return view('employees.disaster.show', compact('employeeDisaster','employee'));
    }

    /**
     * Show the form for editing the specified employee disaster.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeDisasters)
    {
        $employee = Employee::findOrFail($employee);
        $employeeDisaster = EmployeeDisaster::findOrFail($employeeDisasters);
        $disasterCauses = DisasterCause::pluck('name', 'id')->all();
        $disasterSeverities = DisasterSeverity::pluck('name', 'id')->all();

        return view('employees.disaster.edit', compact('employeeDisaster', 'employee', 'disasterCauses', 'disasterSeverities'));
    }

    /**
     * Update the specified employee disaster in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeDisasters, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeDisaster = EmployeeDisaster::findOrFail($employeeDisasters);
            $data['employee'] = $employee;
            $employeeDisaster->update($data);

            return redirect()->route('employee_disasters.employee_disaster.index',$employee)
                ->with('success_message', 'Employee Disaster was successfully updated.');
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
     * Remove the specified employee disaster from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeDisasters)
    {
        try {
            $employeeDisaster = EmployeeDisaster::findOrFail($employeeDisasters);
            $employeeDisaster->delete();

            return redirect()->route('employee_disasters.employee_disaster.index',$employee)
                ->with('success_message', 'Employee Disaster was successfully deleted.');
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
            'occured_on' => 'required',
            'cause' => 'required',
            'severity' => 'required',
            'description' => 'required|string|min:1|max:1000',
            'attachment' => ['file'],
            'is_mass' => 'boolean|nullable',
            'status' => 'string|min:1|nullable',
            'note' => 'string|min:1|max:1000|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
        ];
        if ($request->route()->getAction()['as'] == 'employee_disasters.employeedisaster.store' || $request->has('custom_delete_attachment')) {
            array_push($rules['attachment'], 'required');
        }
        $data = $request->validate($rules);
        if ($request->has('custom_delete_attachment')) {
            $data['attachment'] = '';
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $this->moveFile($request->file('attachment'));
        }
        $data['is_mass'] = $request->has('is_mass');

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
