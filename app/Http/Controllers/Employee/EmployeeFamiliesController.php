<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeFamily;
use App\Models\Relationship;
use App\Models\Sex;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use Exception;

class EmployeeFamiliesController extends Controller
{

    /**
     * Display a listing of the employee families.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeFamilies = DB::table('employee_families')
            ->join('employees', 'employee_families.employee', '=', 'employees.id')
            ->join('relationships', 'employee_families.relationship', '=', 'relationships.id')
            ->join('sexes', 'employee_families.sex', '=', 'sexes.id')
            ->select('employee_families.*', 'employees.en_name', 'relationships.name as relation', 'sexes.name as sex')
            ->paginate(25);

        return view('employees.family.index', compact('employeeFamilies'));
    }

    /**
     * Show the form for creating a new employee family.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $sexes = Sex::pluck('name', 'id')->all();
        $relationships = Relationship::pluck('name', 'id')->all();
        $creators = User::pluck('name', 'id')->all();
        $approvedBies = User::pluck('name', 'id')->all();

        return view('employees.family.create', compact('employees', 'sexes', 'relationships', 'creators', 'approvedBies'));
    }

    /**
     * Store a new employee family in the storage.
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
            EmployeeFamily::create($data);

            return redirect()->route('employee_families.employee_family.index')
                ->with('success_message', 'Employee Family was successfully added.');
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
     * Approve the specified employee family
     *
     * @param int $id
     */
    public function approve($id)
    {
        try {

            $employeeFamily = EmployeeFamily::findOrFail($id);
            $employeeFamily->status = '3';
            $employeeFamily->approved_by = '1';
            $employeeFamily->approved_at = now();
            $employeeFamily->save();

            return redirect()->route('employee_families.employee_family.index')
                ->with('success_message', 'Employee Family was successfully approved.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * reject the specified employee family
     *
     * @param int $id
     */
    public function reject($id, Request $request)
    {
        try {

            $employeeFamily = EmployeeFamily::findOrFail($id);
            $employeeFamily->status = '2';
            $employeeFamily->note = '1';
            $employeeFamily->save();

            return redirect()->route('employee_families.employee_family.index')
                ->with('success_message', 'Employee Family was successfully rejected.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified employee family.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeFamily = EmployeeFamily::findOrFail($id);
        $employees = Employee::pluck('title', 'id')->all();
        $sexes = Sex::pluck('name', 'id')->all();
        $relationships = Relationship::pluck('name', 'id')->all();
        $creators = User::pluck('name', 'id')->all();
        $approvedBies = User::pluck('id', 'id')->all();

        return view('employees.family.edit', compact('employeeFamily', 'employees', 'sexes', 'relationships', 'creators', 'approvedBies'));
    }

    /**
     * Update the specified employee family in the storage.
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

            $employeeFamily = EmployeeFamily::findOrFail($id);
            $employeeFamily->update($data);

            return redirect()->route('employee_families.employee_family.index')
                ->with('success_message', 'Employee Family was successfully updated.');
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
     * Remove the specified employee family from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeFamily = EmployeeFamily::findOrFail($id);
            $employeeFamily->delete();

            return redirect()->route('employee_families.employee_family.index')
                ->with('success_message', 'Employee Family was successfully deleted.');
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
            'name' => 'required|string|min:1|max:255',
            'sex' => 'required',
            'relationship' => 'required',
            'date_of_birth' => 'required',
            'photo' => ['file', 'nullable'],
            'file' => ['file', 'nullable'],
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
            'note' => 'string|min:1|max:1000|nullable',
        ];

        $data = $request->validate($rules);
        if ($request->has('custom_delete_photo')) {
            $data['photo'] = null;
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->moveFile($request->file('photo'));
        }
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
