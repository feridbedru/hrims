<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAdditionalInfo;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeAdditionalInfosController extends Controller
{

    /**
     * Display a listing of the employee additional infos.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeAdditionalInfos = EmployeeAdditionalInfo::where('employee', $employee_id)->with('employees', 'nationalities', 'religions', 'maritalStatuses')->paginate(25);

        return view('employees.additional_info.index', compact('employeeAdditionalInfos', 'employee'));
    }

    /**
     * Show the form for creating a new employee additional info.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $nationalities = Nationality::pluck('name', 'id')->all();
        $religions = Religion::pluck('name', 'id')->all();
        $maritalStatuses = MaritalStatus::pluck('name', 'id')->all();
        $employeeAdditionalInfos = EmployeeAdditionalInfo::all();
        $employeeAdditionalInfo = EmployeeAdditionalInfo::where('employee', $id)->with('employees');

        return view('employees.additional_info.create', compact('employee', 'nationalities', 'religions', 'maritalStatuses', 'employeeAdditionalInfos', 'employeeAdditionalInfo'));
    }

    /**
     * Store a new employee additional info in the storage.
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
            EmployeeAdditionalInfo::create($data);

            return redirect()->route('employee_additional_infos.employee_additional_info.index', $employee)
                ->with('success_message', 'Employee Additional Info was successfully added.');
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
     * Show the form for editing the specified employee additional info.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeAdditionalInfos)
    {
        $employeeAdditionalInfo = EmployeeAdditionalInfo::findOrFail($employeeAdditionalInfos);
        $employee = Employee::findOrFail($employee);
        $nationalities = Nationality::pluck('name', 'id')->all();
        $religions = Religion::pluck('name', 'id')->all();
        $maritalStatuses = MaritalStatus::pluck('name', 'id')->all();

        return view('employees.additional_info.edit', compact('employeeAdditionalInfo', 'employee', 'nationalities', 'religions', 'maritalStatuses'));
    }

    //Prints employee additional information
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeAdditionalInfos = EmployeeAdditionalInfo::with('employees', 'nationalities', 'religions', 'maritalStatuses')->get();

        return view('employees.additional_info.print', compact('employeeAdditionalInfos', 'employee'));
    }

    /**
     * Update the specified employee additional info in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeAdditionalInfos, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeAdditionalInfo = EmployeeAdditionalInfo::findOrFail($employeeAdditionalInfos);
            $data['employee'] = $employee;
            $employeeAdditionalInfo->update($data);

            return redirect()->route('employee_additional_infos.employee_additional_info.index', $employee)
                ->with('success_message', 'Employee Additional Info was successfully updated.');
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
     * Remove the specified employee additional info from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeAdditionalInfos)
    {
        try {
            $employeeAdditionalInfo = EmployeeAdditionalInfo::findOrFail($employeeAdditionalInfos);
            $employeeAdditionalInfo->delete();

            return redirect()->route('employee_additional_infos.employee_additional_info.index', $employee)
                ->with('success_message', 'Employee Additional Info was successfully deleted.');
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
            'place_of_birth' => 'string|min:1|nullable',
            'other_phone_number' => 'numeric|nullable',
            'nationality' => 'nullable',
            'religion' => 'nullable',
            'blood_group' => 'string|min:1|nullable',
            'tin_number' => 'string|nullable|numeric',
            'pension' => 'string|min:1|nullable',
            'marital_status' => 'nullable',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
