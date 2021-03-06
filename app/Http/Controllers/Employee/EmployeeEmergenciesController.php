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
    public function index()
    {
        $employeeEmergencies = EmployeeEmergency::with('employees','relationships')->paginate(25);

        return view('employees.emergency.index', compact('employeeEmergencies'));
    }

    /**
     * Show the form for creating a new employee emergency.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $relationships = Relationship::pluck('name', 'id')->all();

        return view('employees.emergency.create', compact('employees', 'relationships'));
    }

    /**
     * Store a new employee emergency in the storage.
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
            EmployeeEmergency::create($data);

            return redirect()->route('employee_emergencies.employee_emergency.index')
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
    public function approve($id)
    {
        try {

            $employeeEmergency = EmployeeEmergency::findOrFail($id);
            $employeeEmergency->status = 3;
            $employeeEmergency->approved_by = 1;
            $employeeEmergency->approved_at = now();
            $employeeEmergency->save();

            return redirect()->route('employee_emergencies.employee_emergency.index')
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
    public function reject($id, Request $request)
    {
        try {

            $employeeEmergency = EmployeeEmergency::findOrFail($id);
            $employeeEmergency->status = 2;
            $employeeEmergency->note = 1;
            $employeeEmergency->save();

            return redirect()->route('employee_emergencies.employee_emergency.index')
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
    public function edit($id)
    {
        $employeeEmergency = EmployeeEmergency::findOrFail($id);
        $employees = Employee::pluck('en_name', 'id')->all();
        $relationships = Relationship::pluck('name', 'id')->all();

        return view('employees.emergency.edit', compact('employeeEmergency', 'employees', 'relationships'));
    }

    /**
     * Update the specified employee emergency in the storage.
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

            $employeeEmergency = EmployeeEmergency::findOrFail($id);
            $employeeEmergency->update($data);

            return redirect()->route('employee_emergencies.employee_emergency.index')
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
    public function destroy($id)
    {
        try {
            $employeeEmergency = EmployeeEmergency::findOrFail($id);
            $employeeEmergency->delete();

            return redirect()->route('employee_emergencies.employee_emergency.index')
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
            'employee' => 'required',
            'name' => 'required|string|min:1|max:255',
            'phone_number' => 'numeric|nullable',
            'relationship' => 'required',
            'address' => 'string|min:1|nullable',
            'house_number' => 'string|nullable',
            'other_phone' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
            'note' => 'string|min:1|max:1000|nullable',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
