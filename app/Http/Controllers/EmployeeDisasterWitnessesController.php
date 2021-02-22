<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDisaster;
use App\Models\EmployeeDisasterWitness;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class EmployeeDisasterWitnessesController extends Controller
{

    /**
     * Display a listing of the employee disaster witnesses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeDisasterWitnesses = EmployeeDisasterWitness::with('employeedisaster','creator')->paginate(25);

        return view('employee_disaster_witnesses.index', compact('employeeDisasterWitnesses'));
    }

    /**
     * Show the form for creating a new employee disaster witness.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employeeDisasters = EmployeeDisaster::pluck('approved_at','id')->all();
$creators = User::pluck('name','id')->all();
        
        return view('employee_disaster_witnesses.create', compact('employeeDisasters','creators'));
    }

    /**
     * Store a new employee disaster witness in the storage.
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
            EmployeeDisasterWitness::create($data);

            return redirect()->route('employee_disaster_witnesses.employee_disaster_witness.index')
                ->with('success_message', 'Employee Disaster Witness was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee disaster witness.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeDisasterWitness = EmployeeDisasterWitness::with('employeedisaster','creator')->findOrFail($id);

        return view('employee_disaster_witnesses.show', compact('employeeDisasterWitness'));
    }

    /**
     * Show the form for editing the specified employee disaster witness.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeDisasterWitness = EmployeeDisasterWitness::findOrFail($id);
        $employeeDisasters = EmployeeDisaster::pluck('approved_at','id')->all();
$creators = User::pluck('name','id')->all();

        return view('employee_disaster_witnesses.edit', compact('employeeDisasterWitness','employeeDisasters','creators'));
    }

    /**
     * Update the specified employee disaster witness in the storage.
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
            
            $employeeDisasterWitness = EmployeeDisasterWitness::findOrFail($id);
            $employeeDisasterWitness->update($data);

            return redirect()->route('employee_disaster_witnesses.employee_disaster_witness.index')
                ->with('success_message', 'Employee Disaster Witness was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee disaster witness from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeDisasterWitness = EmployeeDisasterWitness::findOrFail($id);
            $employeeDisasterWitness->delete();

            return redirect()->route('employee_disaster_witnesses.employee_disaster_witness.index')
                ->with('success_message', 'Employee Disaster Witness was successfully deleted.');
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
                'disaster' => 'required',
            'name' => 'required|string|min:1|max:255',
            'phone' => 'string|min:1|nullable',
            'file' => ['file','nullable'],
            'created_by' => 'nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = null;
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
        
        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
