<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\AddressType;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\User;
use App\Models\Region;
use App\Models\Woreda;
use App\Models\Zone;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeAddressesController extends Controller
{

    /**
     * Display a listing of the employee addresses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeAddresses = EmployeeAddress::with('employees', 'types', 'woredas')->paginate(25);

        return view('employees.address.index', compact('employeeAddresses'));
    }

    /**
     * Show the form for creating a new employee address.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $addressTypes = AddressType::pluck('name', 'id')->all();
        $regions = Region::pluck('name', 'id')->all();
        $woredas = Woreda::pluck('name', 'id')->all();
        $zones = Zone::pluck('name', 'id')->all();

        return view('employees.address.create', compact('employees', 'addressTypes', 'regions', 'woredas', 'zones'));
    }

    /**
     * Store a new employee address in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            $data['created_by'] = Auth::Id();
            $data['status'] = '1';
            EmployeeAddress::create($data);

            return redirect()->route('employee_addresses.employee_address.index')
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
    public function approve($id)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($id);
            $employeeAddress->status = '3';
            $employeeAddress->approved_by = Auth::Id();
            $employeeAddress->approved_at = now();
            $employeeAddress->save();
            return redirect()->route('employee_addresses.employee_address.index')
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
    public function reject($id, Request $request)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($id);
            $employeeAddress->status = '2';
            $employeeAddress->note = '1';
            $employeeAddress->save();
            return redirect()->route('employee_addresses.employee_address.index')
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
    public function edit($id)
    {
        $employeeAddress = EmployeeAddress::findOrFail($id);
        $employees = Employee::pluck('en_name', 'id')->all();
        $addressTypes = AddressType::pluck('name', 'id')->all();
        $regions = Region::pluck('name', 'id')->all();
        $woredas = Woreda::pluck('name', 'id')->all();
        $zones = Zone::pluck('name', 'id')->all();

        return view('employees.address.edit', compact('employeeAddress', 'employees', 'addressTypes', 'regions', 'woredas', 'zones'));
    }

    /**
     * Update the specified employee address in the storage.
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

            $employeeAddress = EmployeeAddress::findOrFail($id);
            $employeeAddress->update($data);

            return redirect()->route('employee_addresses.employee_address.index')
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
    public function destroy($id)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($id);
            $employeeAddress->delete();

            return redirect()->route('employee_addresses.employee_address.index')
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
            'employee' => 'required',
            'address_type' => 'required',
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
