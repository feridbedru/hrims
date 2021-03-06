<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\CommitmentFor;
use App\Models\EducationalField;
use App\Models\EducationalInstitute;
use App\Models\EducationLevel;
use App\Models\Employee;
use App\Models\EmployeeStudyTraining;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        $employeeStudyTrainings = EmployeeStudyTraining::with('employees','types','institutions','fields','levels')->paginate(25);

        return view('employees.study_training.index', compact('employeeStudyTrainings'));
    }

    /**
     * Show the form for creating a new employee study training.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $commitmentFors = CommitmentFor::pluck('name', 'id')->all();
        $educationalInstitutions = EducationalInstitute::pluck('name', 'id')->all();
        $educationalLevels = EducationLevel::pluck('name', 'id')->all();
        $educationalFields = EducationalField::pluck('name', 'id')->all();

        return view('employees.study_training.create', compact('employees', 'commitmentFors', 'educationalInstitutions', 'educationalLevels', 'educationalFields'));
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
     * Display the specified employee study training.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeStudyTraining = EmployeeStudyTraining::with('employees','types','institutions','fields','levels')->findOrFail($id);

        return view('employees.study_training.show', compact('employeeStudyTraining'));
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
        $employees = Employee::pluck('en_name', 'id')->all();
        $commitmentFors = CommitmentFor::pluck('name', 'id')->all();
        $educationalInstitutions = EducationalInstitute::pluck('name', 'id')->all();
        $educationalLevels = EducationLevel::pluck('name', 'id')->all();
        $educationalFields = EducationalField::pluck('name', 'id')->all();

        return view('employees.study_training.edit', compact('employeeStudyTraining', 'employees', 'commitmentFors', 'educationalInstitutions', 'educationalLevels', 'educationalFields'));
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
            'type' => 'required',
            'institution' => 'required',
            'level' => 'required',
            'field' => 'required',
            'start_date' => 'nullable',
            'duration' => 'string|min:1|nullable',
            'has_commitment' => 'boolean|nullable',
            'total_commitment' => 'numeric|nullable',
            'amount' => 'numeric|nullable',
            'attachment' => ['file', 'nullable'],
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
