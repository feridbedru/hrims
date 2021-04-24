<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeJudiciaryPunishment;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeJudiciaryPunishmentsController extends Controller
{

    /**
     * Display a listing of the employee judiciary punishments.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeJudiciaryPunishments = EmployeeJudiciaryPunishment::where('employee', $employee_id)->with('employees')->paginate(25);

        return view('employees.judiciary_punishment.index', compact('employeeJudiciaryPunishments', 'employee'));
    }

    /**
     * Show the form for creating a new employee judiciary punishment.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.judiciary_punishment.create', compact('employee'));
    }

    /**
     * Store a new employee judiciary punishment in the storage.
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

            EmployeeJudiciaryPunishment::create($data);

            return redirect()->route('employee_judiciary_punishments.employee_judiciary_punishment.index', $employee)
                ->with('success_message', 'Employee Judiciary Punishment was successfully added.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified employee judiciary punishment.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeJudiciaryPunishments)
    {
        $employeeJudiciaryPunishment = EmployeeJudiciaryPunishment::findOrFail($employeeJudiciaryPunishments);
        $employee = Employee::findOrFail($employee);

        return view('employees.judiciary_punishment.edit', compact('employeeJudiciaryPunishment', 'employee'));
    }

    //Prints employee judiciary punishment
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeJudiciaryPunishments = EmployeeJudiciaryPunishment::where('employee', $employee_id)->with('employees')->get();

        return view('employees.judiciary_punishment.print', compact('employeeJudiciaryPunishments', 'employee'));
    }

    /**
     * Update the specified employee judiciary punishment in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeJudiciaryPunishments, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeJudiciaryPunishment = EmployeeJudiciaryPunishment::findOrFail($employeeJudiciaryPunishments);
            $data['employee'] = $employee;
            $employeeJudiciaryPunishment->update($data);

            return redirect()->route('employee_judiciary_punishments.employee_judiciary_punishment.index', $employee)
                ->with('success_message', 'Employee Judiciary Punishment was successfully updated.');
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
     * Remove the specified employee judiciary punishment from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeJudiciaryPunishments)
    {
        try {
            $employeeJudiciaryPunishment = EmployeeJudiciaryPunishment::findOrFail($employeeJudiciaryPunishments);
            $employeeJudiciaryPunishment->delete();

            return redirect()->route('employee_judiciary_punishments.employee_judiciary_punishment.index')
                ->with('success_message', 'Employee Judiciary Punishment was successfully deleted.');
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
            'court_name' => 'required|string|min:1',
            'reason' => 'required|string|min:1',
            'punishment_type' => 'required|string|min:1',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'file' => ['file'],
            'status' => 'nullable|string|min:1',
        ];
        if ($request->route()->getAction()['as'] == 'employee_judiciary_punishments.employeejudiciarypunishment.store' || $request->has('custom_delete_file')) {
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
