<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CommitmentFor;
use App\Models\EducationalField;
use App\Models\EducationalInstitute;
use App\Models\EducationLevel;
use App\Models\Employee;
use App\Models\EmployeeStudyTraining;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;

class EmployeeStudyTrainingsController extends Controller
{

    /**
     * Display a listing of the employee study trainings.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        // $employeeStudyTrainings = EmployeeStudyTraining::with('employee','commitmentfor','educationalinstitution','educationallevel','educationalfield','creator')->paginate(25);
        $employeeStudyTrainings = DB::table('employee_study_trainings')
                                ->join('employees','employee_study_trainings.employee','=','employees.id')
                                ->join('commitment_fors','employee_study_trainings.type','=','commitment_fors.id')
                                ->join('educational_institutes','employee_study_trainings.institution','=','educational_institutes.id')
                                ->join('education_levels','employee_study_trainings.level','=','education_levels.id')
                                ->join('educational_fields','employee_study_trainings.field','=','educational_fields.id')
                                ->select('employee_study_trainings.*','employees.en_name','commitment_fors.name as type','educational_institutes.name as institution','education_levels.name as level','educational_fields.name as field')
                                ->paginate(25);
        return view('employee_study_trainings.index', compact('employeeStudyTrainings'));
    }

    /**
     * Show the form for creating a new employee study training.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $commitmentFors = CommitmentFor::pluck('name','id')->all();
        $educationalInstitutions = EducationalInstitute::pluck('name','id')->all();
        $educationalLevels = EducationLevel::pluck('name','id')->all();
        $educationalFields = EducationalField::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        
        return view('employee_study_trainings.create', compact('employees','commitmentFors','educationalInstitutions','educationalLevels','educationalFields','creators'));
    }

    /**
     * Store a new employee study training in the storage.
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
            EmployeeStudyTraining::create($data);

            return redirect()->route('employee_study_trainings.employee_study_training.index')
                ->with('success_message', 'Employee Study Training was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee study training.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeStudyTraining = EmployeeStudyTraining::with('employee','commitmentfor','educationalinstitution','educationallevel','educationalfield','creator')->findOrFail($id);

        return view('employee_study_trainings.show', compact('employeeStudyTraining'));
    }

    /**
     * Show the form for editing the specified employee study training.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeStudyTraining = EmployeeStudyTraining::findOrFail($id);
        $employees = Employee::pluck('en_name','id')->all();
        $commitmentFors = CommitmentFor::pluck('name','id')->all();
        $educationalInstitutions = EducationalInstitute::pluck('name','id')->all();
        $educationalLevels = EducationLevel::pluck('name','id')->all();
        $educationalFields = EducationalField::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();

        return view('employee_study_trainings.edit', compact('employeeStudyTraining','employees','commitmentFors','educationalInstitutions','educationalLevels','educationalFields','creators'));
    }

    /**
     * Update the specified employee study training in the storage.
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
            
            $employeeStudyTraining = EmployeeStudyTraining::findOrFail($id);
            $employeeStudyTraining->update($data);

            return redirect()->route('employee_study_trainings.employee_study_training.index')
                ->with('success_message', 'Employee Study Training was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee study training from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeStudyTraining = EmployeeStudyTraining::findOrFail($id);
            $employeeStudyTraining->delete();

            return redirect()->route('employee_study_trainings.employee_study_training.index')
                ->with('success_message', 'Employee Study Training was successfully deleted.');
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
            'Type' => 'required',
            'institution' => 'required',
            'level' => 'required',
            'field' => 'required',
            'start_date' => 'nullable',
            'duration' => 'string|min:1|nullable',
            'has_commitment' => 'boolean|nullable',
            'total_commitment' => 'numeric|nullable',
            'attachment' => ['file','nullable'],
            'created_by' => 'nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_attachment')) {
            $data['attachment'] = null;
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $this->moveFile($request->file('attachment'));
        }
        $data['has_commitment'] = $request->has('has_commitment');

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
