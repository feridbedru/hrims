<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeEmergency;
use App\Models\Relationship;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeEmergenciesController extends Controller
{

    /**
     * Display a listing of the employee emergencies.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeEmergencies = EmployeeEmergency::where('employee', $employee_id)->with('employees','relationships')->paginate(25);

        return view('employees.emergency.index', compact('employeeEmergencies','employee'));
    }

    /**
     * Show the form for creating a new employee emergency.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $relationships = Relationship::pluck('name', 'id')->all();

        return view('employees.emergency.create', compact('employee', 'relationships'));
    }

    /**
     * Store a new employee emergency in the storage.
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
            EmployeeEmergency::create($data);

            return redirect()->route('employee_emergencies.employee_emergency.index',$employee)
                ->with('success_message', 'Employee Emergency was successfully added.');
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
     * Approve the specified employee emergency
     *
     * @param int $id
     */
    public function approve($employee, $employeeEmergencies)
    {
        try {

            $employeeEmergency = EmployeeEmergency::findOrFail($employeeEmergencies);
            $employeeEmergency->status = 3;
            $employeeEmergency->approved_by = 1;
            $employeeEmergency->approved_at = now();
            $employeeEmergency->save();

            return redirect()->route('employee_emergencies.employee_emergency.index',$employee)
                ->with('success_message', 'Employee Emergency was successfully approved.');
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
     * reject the specified employee emergency
     *
     * @param int $id
     */
    public function reject($employee, $employeeEmergencies, Request $request)
    {
        try {

            $employeeEmergency = EmployeeEmergency::findOrFail($employeeEmergencies);
            $employeeEmergency->status = 2;
            $employeeEmergency->note = $request['note'];
            $employeeEmergency->save();

            return redirect()->route('employee_emergencies.employee_emergency.index',$employee)
                ->with('success_message', 'Employee Emeregency was successfully rejected.');
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
     * Show the form for editing the specified employee emergency.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeEmergencies)
    {
        $employee = Employee::findOrFail($employee);
        $employeeEmergency = EmployeeEmergency::findOrFail($employeeEmergencies);
        $relationships = Relationship::pluck('name', 'id')->all();

        return view('employees.emergency.edit', compact('employeeEmergency', 'employee', 'relationships'));
    }

    /**
     * Update the specified employee emergency in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeEmergencies, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeEmergency = EmployeeEmergency::findOrFail($employeeEmergencies);
            $data['employee'] = $employee;
            $employeeEmergency->update($data);

            return redirect()->route('employee_emergencies.employee_emergency.index',$employee)
                ->with('success_message', 'Employee Emergency was successfully updated.');
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
     * Remove the specified employee emergency from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeEmergencies)
    {
        try {
            $employeeEmergency = EmployeeEmergency::findOrFail($employeeEmergencies);
            $employeeEmergency->delete();

            return redirect()->route('employee_emergencies.employee_emergency.index',$employee)
                ->with('success_message', 'Employee Emergency was successfully deleted.');
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
            'phone_number' => 'numeric|nullable',
            'relationship' => 'required',
            'address' => 'string|min:1|nullable',
            'house_number' => 'string|nullable',
            'other_phone' => 'string|min:1|nullable',
            'status' => 'numeric|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
            'note' => 'string|min:1|max:1000|nullable',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
