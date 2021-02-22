<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DisasterCause;
use App\Models\DisasterSeverity;
use App\Models\Employee;
use App\Models\EmployeeDisaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use DB;
use Exception;

class EmployeeDisastersController extends Controller
{

    /**
     * Display a listing of the employee disasters.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        // $employeeDisasters = EmployeeDisaster::with('employee','disastercause','disasterseverity','creator','approvedby')->paginate(25);
        $employeeDisasters = DB::table('employee_disasters')
                                ->join('employees','employee_disasters.employee','=','employees.id')
                                ->join('disaster_causes','employee_disasters.cause','=','disaster_causes.id')
                                ->join('disaster_severities','employee_disasters.severity','=','disaster_severities.id')
                                ->select('employee_disasters.*','employees.en_name','disaster_causes.name as cause','disaster_severities.name as severity')
                                ->paginate(25);

        return view('employee_disasters.index', compact('employeeDisasters'));
    }

    /**
     * Show the form for creating a new employee disaster.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $disasterCauses = DisasterCause::pluck('name','id')->all();
        $disasterSeverities = DisasterSeverity::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();
        
        return view('employee_disasters.create', compact('employees','disasterCauses','disasterSeverities','creators','approvedBies'));
    }

    /**
     * Store a new employee disaster in the storage.
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
            EmployeeDisaster::create($data);

            return redirect()->route('employee_disasters.employee_disaster.index')
                ->with('success_message', 'Employee Disaster was successfully added.');
        } catch (Exception $exception) {

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
    public function show($id)
    {
        $employeeDisaster = EmployeeDisaster::with('employee','disastercause','disasterseverity','creator','approvedby')->findOrFail($id);

        return view('employee_disasters.show', compact('employeeDisaster'));
    }

    /**
     * Show the form for editing the specified employee disaster.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeDisaster = EmployeeDisaster::findOrFail($id);
        $employees = Employee::pluck('en_name','id')->all();
        $disasterCauses = DisasterCause::pluck('name','id')->all();
        $disasterSeverities = DisasterSeverity::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        $approvedBies = User::pluck('id','id')->all();

        return view('employee_disasters.edit', compact('employeeDisaster','employees','disasterCauses','disasterSeverities','creators','approvedBies'));
    }

    /**
     * Update the specified employee disaster in the storage.
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
            
            $employeeDisaster = EmployeeDisaster::findOrFail($id);
            $employeeDisaster->update($data);

            return redirect()->route('employee_disasters.employee_disaster.index')
                ->with('success_message', 'Employee Disaster was successfully updated.');
        } catch (Exception $exception) {

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
    public function destroy($id)
    {
        try {
            $employeeDisaster = EmployeeDisaster::findOrFail($id);
            $employeeDisaster->delete();

            return redirect()->route('employee_disasters.employee_disaster.index')
                ->with('success_message', 'Employee Disaster was successfully deleted.');
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
