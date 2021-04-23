<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAdministrativePunishment;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeAdministrativePunishmentsController extends Controller
{

    /**
     * Display a listing of the employee administrative punishments.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeAdministrativePunishments = EmployeeAdministrativePunishment::where('employee', $employee_id)->with('employees')->paginate(25);

        return view('employees.administrative_punishment.index', compact('employeeAdministrativePunishments', 'employee'));
    }

    /**
     * Show the form for creating a new employee administrative punishment.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.administrative_punishment.create', compact('employee'));
    }

    /**
     * Store a new employee administrative punishment in the storage.
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

            EmployeeAdministrativePunishment::create($data);

            return redirect()->route('employee_administrative_punishments.employee_administrative_punishment.index', $employee)
                ->with('success_message', 'Employee Administrative Punishment was successfully added.');
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
     * Show the form for editing the specified employee administrative punishment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeAdministrativePunishments)
    {
        $employeeAdministrativePunishment = EmployeeAdministrativePunishment::findOrFail($employeeAdministrativePunishments);
        $employee = Employee::findOrFail($employee);

        return view('employees.administrative_punishment.edit', compact('employeeAdministrativePunishment', 'employee'));
    }

    //Prints employee administrative punishment
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeAdministrativePunishments = EmployeeAdministrativePunishment::where('employee', $employee_id)->with('employees')->get();

        return view('employees.administrative_punishment.print', compact('employeeAdministrativePunishments', 'employee'));
    }

    /**
     * Update the specified employee administrative punishment in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeAdministrativePunishments, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeAdministrativePunishment = EmployeeAdministrativePunishment::findOrFail($employeeAdministrativePunishments);
            $data['employee'] = $employee;
            $employeeAdministrativePunishment->update($data);

            return redirect()->route('employee_administrative_punishments.employee_administrative_punishment.index', $employee)
                ->with('success_message', 'Employee Administrative Punishment was successfully updated.');
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
     * Remove the specified employee administrative punishment from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeAdministrativePunishments)
    {
        try {
            $employeeAdministrativePunishment = EmployeeAdministrativePunishment::findOrFail($employeeAdministrativePunishments);
            $employeeAdministrativePunishment->delete();

            return redirect()->route('employee_administrative_punishments.employee_administrative_punishment.index', $employee)
                ->with('success_message', 'Employee Administrative Punishment was successfully deleted.');
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
            'organization_name' => 'required|string|min:1',
            'reason' => 'required|string|min:1',
            'decision' => 'required|string|min:1',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'file' => ['file'],
            'status' => 'string|min:1|nullable',
        ];
        if ($request->route()->getAction()['as'] == 'employee_administrative_punishments.employeeadministrativepunishment.store' || $request->has('custom_delete_file')) {
            array_push($rules['file'], 'required');
        }
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = '';
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

        if (!file_exists('uploads/punishment')) {
            mkdir('uploads/punishment', 0777, true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/punishment', $fileName);

        return $fileName;
    }
}
