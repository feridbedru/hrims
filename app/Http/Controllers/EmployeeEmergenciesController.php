<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeEmergency;
use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
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
        $employeeEmergencies = DB::table('employee_emergencies')
                                ->join('employees','employee_emergencies.employee','=','employees.id')
                                ->join('relationships','employee_emergencies.relationship','=','relationships.id')
                                ->select('employee_emergencies.*','employees.en_name','relationships.name as relation')
                                ->paginate(25);

        return view('employee_emergencies.index', compact('employeeEmergencies'));
    }

    /**
     * Show the form for creating a new employee emergency.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $relationships = Relationship::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('name','id')->all();
        
        return view('employee_emergencies.create', compact('employees','relationships','creators','approvedBies'));
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
            $employeeEmergency->status = '3';
            $employeeEmergency->approved_by = '1';
            $employeeEmergency->approved_at = now();
            $employeeEmergency->save();

            return redirect()->route('employee_emergencies.employee_emergency.index')
                ->with('success_message', 'Employee Emergency was successfully approved.');
        } catch (Exception $exception) {

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
            $employeeEmergency->status = '2';
            $employeeEmergency->note = '1';
            $employeeEmergency->save();

            return redirect()->route('employee_emergencies.employee_emergency.index')
                ->with('success_message', 'Employee Emeregency was successfully rejected.');
        } catch (Exception $exception) {

            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee emergency.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeEmergency = EmployeeEmergency::with('employee','relationship','creator','approvedby')->findOrFail($id);

        return view('employee_emergencies.show', compact('employeeEmergency'));
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
        $employees = Employee::pluck('en_name','id')->all();
        $relationships = Relationship::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('name','id')->all();

        return view('employee_emergencies.edit', compact('employeeEmergency','employees','relationships','creators','approvedBies'));
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
