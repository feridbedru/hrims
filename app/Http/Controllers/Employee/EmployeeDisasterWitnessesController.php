<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDisaster;
use App\Models\EmployeeDisasterWitness;
use App\Models\User;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        $employeeDisasterWitnesses = EmployeeDisasterWitness::with('disasters')->paginate(25);

        return view('employees.disaster_witness.index', compact('employeeDisasterWitnesses'));
    }

    /**
     * Show the form for creating a new employee disaster witness.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employeeDisasters = EmployeeDisaster::pluck('occured_on', 'id')->all();

        return view('employees.disaster_witness.create', compact('employeeDisasters'));
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
     * Display the specified employee disaster witness.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeDisasterWitness = EmployeeDisasterWitness::with('disasters')->findOrFail($id);

        return view('employees.disaster_witness.show', compact('employeeDisasterWitness'));
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
        $employeeDisasters = EmployeeDisaster::pluck('occured_on', 'id')->all();

        return view('employees.disaster_witness.edit', compact('employeeDisasterWitness', 'employeeDisasters', 'creators'));
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
            'disaster' => 'required',
            'name' => 'required|string|min:1|max:255',
            'phone' => 'string|min:1|nullable',
            'file' => ['file', 'nullable'],
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

        if (!file_exists('uploads/disaster/witness'))
        {
            mkdir('uploads/disaster/witness', 0777 , true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/disaster/witness', $fileName);
        
        return $fileName;
    }
}
