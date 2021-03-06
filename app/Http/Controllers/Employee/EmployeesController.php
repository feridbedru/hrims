<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use App\Models\JobPosition;
use App\Models\JobTitleCategory;
use App\Models\OrganizationUnit;
use App\Models\Sex;
use App\Models\Title;
use App\Models\User;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use Exception;

class EmployeesController extends Controller
{

    /**
     * Display a listing of the employees.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::with('title', 'sex', 'organizationunit', 'jobposition', 'employeestatus', 'creator')->paginate(25);
        $jobPositions = JobPosition::pluck('job_title_category', 'id');
        $sexes = Sex::pluck('name', 'id');
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();

        return view('employees.index', compact('employees', 'jobPositions', 'sexes', 'organizationUnits'));
    }

    /**
     * FIlter a listing of the employees
     *
     * @return Illuminate\View\View
     */
    public function filter(Request $request, Employee $employees)
    {
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $titles = Title::pluck('en_title', 'id')->all();
        $sexes = Sex::pluck('name', 'id')->all();
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobPositions = JobPosition::pluck('job_title_category', 'id')->all();
        // $jobPositions = DB::table('job_positions')->where('status','1')->pluck('job_title_category');
        $employeeStatuses = EmployeeStatus::pluck('name', 'id')->all();
        $creators = User::pluck('name', 'id')->all();

        return view('employees.create', compact('titles', 'sexes', 'organizationUnits', 'jobPositions', 'employeeStatuses', 'creators'));
    }

    /**
     * Store a new employee in the storage.
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
            Employee::create($data);
            $id = DB::getPdo()->lastInsertId();
            $employee = Employee::with('title', 'sex', 'organizationunit', 'jobposition', 'employeestatus', 'creator')->findOrFail($id);
            return view('employees.success', compact('employee'));
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
     * Display the specified employee.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::with('title', 'sex', 'organizationunit', 'jobposition', 'employeestatus', 'creator')->findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    /**
     * Display the successfuly registration of an employee.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function success($id)
    {
        $employee = Employee::with('title', 'sex', 'organizationunit', 'jobposition', 'employeestatus', 'creator')->findOrFail($id);

        return view('employees.success', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $titles = Title::pluck('en_title', 'id')->all();
        $sexes = Sex::pluck('name', 'id')->all();
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobPositions = JobPosition::pluck('job_title_category', 'id')->all();
        $employeeStatuses = EmployeeStatus::pluck('name', 'id')->all();
        $creators = User::pluck('name', 'id')->all();

        return view('employees.edit', compact('employee', 'titles', 'sexes', 'organizationUnits', 'jobPositions', 'employeeStatuses', 'creators'));
    }

    /**
     * Update the specified employee in the storage.
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

            $employee = Employee::findOrFail($id);
            $employee->update($data);

            return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully updated.');
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
     * Remove the specified employee from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully deleted.');
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
            'en_name' => 'string|min:1|nullable',
            'am_name' => 'required|string|min:1',
            'title' => 'nullable',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'photo' => ['file', 'nullable'],
            'phone_number' => 'numeric|nullable',
            'organization_unit' => 'required',
            'job_position' => 'required',
            'employment_id' => 'string|min:1|nullable',
            'status' => 'nullable',
        ];

        $data = $request->validate($rules);
        if ($request->has('custom_delete_photo')) {
            $data['photo'] = null;
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->moveFile($request->file('photo'));
        }
        $data['has_delegate'] = $request->has('has_delegate');

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
