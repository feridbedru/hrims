<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeExperience;
use App\Models\ExperienceType;
use App\Models\LeftReason;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeExperiencesController extends Controller
{

    /**
     * Display a listing of the employee experiences.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeExperiences = EmployeeExperience::with('employees', 'types', 'leftReasons')->paginate(25);

        return view('employees.experience.index', compact('employeeExperiences'));
    }

    /**
     * Show the form for creating a new employee experience.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $experienceTypes = ExperienceType::pluck('name', 'id')->all();
        $leftReasons = LeftReason::pluck('name', 'id')->all();

        return view('employees.experience.create', compact('employees', 'experienceTypes', 'leftReasons'));
    }

    /**
     * Store a new employee experience in the storage.
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
            EmployeeExperience::create($data);

            return redirect()->route('employee_experiences.employee_experience.index')
                ->with('success_message', 'Employee Experience was successfully added.');
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
     * Display the specified employee experience.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeExperience = EmployeeExperience::with('employees', 'types', 'leftReasons')->findOrFail($id);

        return view('employees.experience.show', compact('employeeExperience'));
    }

    /**
     * Show the form for editing the specified employee experience.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeExperience = EmployeeExperience::findOrFail($id);
        $employees = Employee::pluck('en_name', 'id')->all();
        $experienceTypes = ExperienceType::pluck('name', 'id')->all();
        $leftReasons = LeftReason::pluck('name', 'id')->all();

        return view('employees.experience.edit', compact('employeeExperience', 'employees', 'experienceTypes', 'leftReasons'));
    }

    /**
     * Update the specified employee experience in the storage.
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

            $employeeExperience = EmployeeExperience::findOrFail($id);
            $employeeExperience->update($data);

            return redirect()->route('employee_experiences.employee_experience.index')
                ->with('success_message', 'Employee Experience was successfully updated.');
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
     * Remove the specified employee experience from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeExperience = EmployeeExperience::findOrFail($id);
            $employeeExperience->delete();

            return redirect()->route('employee_experiences.employee_experience.index')
                ->with('success_message', 'Employee Experience was successfully deleted.');
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
            'organization_name' => 'required|string|min:1',
            'organization_address' => 'string|min:1|nullable',
            'job_position' => 'required|string|min:1',
            'level' => 'string|min:1|nullable',
            'salary' => 'required|string|min:1',
            'left_reason' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'attachment' => ['file'],
            'status' => 'string|min:1|nullable',
            'note' => 'string|min:1|max:1000|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
        ];
        if ($request->route()->getAction()['as'] == 'employee_experiences.employeeexperience.store' || $request->has('custom_delete_attachment')) {
            array_push($rules['attachment'], 'required');
        }
        $data = $request->validate($rules);
        if ($request->has('custom_delete_attachment')) {
            $data['attachment'] = '';
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $this->moveFile($request->file('attachment'));
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
