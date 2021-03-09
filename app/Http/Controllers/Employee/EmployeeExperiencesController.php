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
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeExperiences = EmployeeExperience::where('employee', $employee_id)->with('employees', 'types', 'leftReasons')->paginate(25);

        return view('employees.experience.index', compact('employeeExperiences','employee'));
    }

    /**
     * Show the form for creating a new employee experience.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $experienceTypes = ExperienceType::pluck('name', 'id')->all();
        $leftReasons = LeftReason::pluck('name', 'id')->all();

        return view('employees.experience.create', compact('employee', 'experienceTypes', 'leftReasons'));
    }

    /**
     * Store a new employee experience in the storage.
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
            $data['status'] = 1;
            $data['created_by'] = 1;
            $data['employee'] = $id;
            EmployeeExperience::create($data);

            return redirect()->route('employee_experiences.employee_experience.index', $employee)
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
    public function show($employee, $employeeExperiences)
    {
        $employee = Employee::findOrFail($employee);
        $employeeExperience = EmployeeExperience::with('employees', 'types', 'leftReasons')->findOrFail($employeeExperiences);

        return view('employees.experience.show', compact('employeeExperience','employee'));
    }

    /**
     * Show the form for editing the specified employee experience.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeExperiences)
    {
        $employee = Employee::findOrFail($employee);
        $employeeExperience = EmployeeExperience::findOrFail($employeeExperiences);
        $experienceTypes = ExperienceType::pluck('name', 'id')->all();
        $leftReasons = LeftReason::pluck('name', 'id')->all();

        return view('employees.experience.edit', compact('employeeExperience', 'employee', 'experienceTypes', 'leftReasons'));
    }

    /**
     * Update the specified employee experience in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeExperiences, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeExperience = EmployeeExperience::findOrFail($employeeExperiences);
            $data['employee'] = $employee;
            $employeeExperience->update($data);

            return redirect()->route('employee_experiences.employee_experience.index',$employee)
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
    public function destroy($employee, $employeeExperiences)
    {
        try {
            $employeeExperience = EmployeeExperience::findOrFail($employeeExperiences);
            $employeeExperience->delete();

            return redirect()->route('employee_experiences.employee_experience.index',$employee)
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

        if (!file_exists('uploads/experience'))
        {
            mkdir('uploads/experience', 0777 , true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/experience', $fileName);
        
        return $fileName;
    }
}
