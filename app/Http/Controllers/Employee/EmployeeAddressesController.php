<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\AddressType;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\Region;
use App\Models\Woreda;
use App\Models\Zone;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;
use PDF;

class EmployeeAddressesController extends Controller
{

    /**
     * Display a listing of the employee addresses.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeAddresses = EmployeeAddress::where('employee', $employee_id)->with('employees', 'types', 'woredas')->paginate(25);

        return view('employees.address.index', compact('employeeAddresses', 'employee'));
    }

    /**
     * Show the form for creating a new employee address.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $addressTypes = AddressType::pluck('name', 'id')->all();
        $regions = Region::pluck('name', 'id')->all();
        $woredas = Woreda::pluck('name', 'id')->all();
        $zones = Zone::pluck('name', 'id')->all();

        return view('employees.address.create', compact('employee', 'addressTypes', 'regions', 'woredas', 'zones'));
    }

    /**
     * Store a new employee address in the storage.
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
            EmployeeAddress::create($data);

            return redirect()->route('employee_addresses.employee_address.index', $employee)
                ->with('success_message', 'Employee Address was successfully added.');
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
     * Approve the specified employee address.
     *
     * @param int $id
     */
    public function approve($employee, $employeeAddresses)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($employeeAddresses);
            $employeeAddress->status = 3;
            $employeeAddress->approved_by = 1;
            $employeeAddress->approved_at = now();
            $employeeAddress->save();
            return redirect()->route('employee_addresses.employee_address.index', $employee)
                ->with('success_message', 'Employee Address was successfully approved.');
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
     * reject the specified employee address.
     *
     * @param int $id
     */
    public function reject($employee, $employeeAddresses, Request $request)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($employeeAddresses);
            $employeeAddress->status = 2;
            $employeeAddress->note = $request['note'];
            $employeeAddress->save();
            return redirect()->route('employee_addresses.employee_address.index', $employee)
                ->with('success_message', 'Employee Address was successfully rejected.');
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
     * Show the form for editing the specified employee address.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeAddresses)
    {
        $employee = Employee::findOrFail($employee);
        $employeeAddress = EmployeeAddress::findOrFail($employeeAddresses);
        $addressTypes = AddressType::pluck('name', 'id')->all();
        $regions = Region::pluck('name', 'id')->all();
        $woredas = Woreda::pluck('name', 'id')->all();
        $zones = Zone::pluck('name', 'id')->all();

        return view('employees.address.edit', compact('employeeAddress', 'employee', 'addressTypes', 'regions', 'woredas', 'zones'));
    }

    //Prints employee address
    public function print($employee){
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $zones = Zone::all();
        $regions = Region::all();
        $employeeAddresses = EmployeeAddress::where('employee', $employee_id)->with('employees', 'types', 'woredas')->get();

        // $pdf = PDF::loadView('employees.address.print', compact('employeeAddresses', 'employee','zones','regions'));
        // return $pdf->download($employee->en_name.' Address.pdf');
        return view('employees.address.print', compact('employeeAddresses', 'employee','zones','regions'));
    }

    /**
     * Update the specified employee address in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeAddresses, Request $request)
    {
        try {
            $data = $this->getData($request);

            $employeeAddress = EmployeeAddress::findOrFail($employeeAddresses);
            $data['employee'] = $employee;
            $employeeAddress->update($data);

            return redirect()->route('employee_addresses.employee_address.index', $employee)
                ->with('success_message', 'Employee Address was successfully updated.');
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
     * Remove the specified employee address from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeAddresses)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($employeeAddresses);
            $employeeAddress->delete();

            return redirect()->route('employee_addresses.employee_address.index', $employee)
                ->with('success_message', 'Employee Address was successfully deleted.');
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
            'address' => 'string|min:1|nullable',
            'house_number' => 'string|min:1|nullable',
            'woreda' => 'nullable',
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
