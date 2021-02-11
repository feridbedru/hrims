<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AddressType;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\User;
use App\Models\Region;
use App\Models\Woreda;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $employeeAddresses = EmployeeAddress::with('employee','addresstype','woreda','creator','approvedby')->paginate(25);

        return view('employee_addresses.index', compact('employeeAddresses'));
    }

    /**
     * Show the form for creating a new employee address.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $addressTypes = AddressType::pluck('name','id')->all();
        $regions = Region::pluck('name','id')->all();
        $woredas = Woreda::pluck('name','id')->all();
        $zones = Zone::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();
        
        return view('employee_addresses.create', compact('employees','addressTypes','regions','woredas','zones','creators','approvedBies'));
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
            $data['created_by'] = '2';
            $data['status'] = '1';
            EmployeeAddress::create($data);

            return redirect()->route('employee_addresses.employee_address.index')
                ->with('success_message', 'Employee Address was successfully added.');
        } catch (Throwable $exception) {
report($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Approve the specified employee address.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function approve($id)
    {
        try {
            $employeeAddress = EmployeeAddress::findOrFail($id);
            $employeeAddress->status = '3';
            $employeeAddress->approved_by = '1';
            $employeeAddress->approved_at = now();
            $employeeAddress->save();
            return redirect()->route('employee_addresses.employee_address.index')
                ->with('success_message', 'Employee Address was successfully accepted.');
        } catch (Exception $exception) {
            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        } 
    }

    /**
     * reject the specified employee address.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
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
            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        } 
    }

    /**
     * Display the specified employee address.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeAddress = EmployeeAddress::with('employee','addresstype','woreda','creator','approvedby')->findOrFail($id);

        return view('employee_addresses.show', compact('employeeAddress'));
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
        $employees = Employee::pluck('en_name','id')->all();
        $addressTypes = AddressType::pluck('name','id')->all();
        $regions = Region::pluck('name','id')->all();
        $woredas = Woreda::pluck('name','id')->all();
        $zones = Zone::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();

        return view('employee_addresses.edit', compact('employeeAddress','employees','addressTypes','regions','woredas','zones','creators','approvedBies'));
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
                'employee_id' => 'required',
                'address_type_id' => 'required',
                'address' => 'string|min:1|nullable',
                'house_number' => 'string|min:1|nullable',
                'woreda_id' => 'nullable',
                'status' => 'string|min:1|nullable',
                'created_by' => 'required',
                'approved_by' => 'nullable',
                'approved_at' => 'date_format:j/n/Y g:i A|nullable',
                'note' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
