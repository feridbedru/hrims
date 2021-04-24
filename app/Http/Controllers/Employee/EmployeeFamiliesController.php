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
use Exception;

class EmployeeFamiliesController extends Controller
{

    /**
     * Display a listing of the employee families.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeFamilies = EmployeeFamily::where('employee', $employee_id)->with('employees','relationships','sexes')->paginate(25);

        return view('employees.family.index', compact('employeeFamilies','employee'));
    }

    /**
     * Show the form for creating a new employee family.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $sexes = Sex::pluck('name', 'id')->all();
        $relationships = Relationship::pluck('name', 'id')->all();

        return view('employees.family.create', compact('employee', 'sexes', 'relationships'));
    }

    /**
     * Store a new employee family in the storage.
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
            $data['created_by'] = 1;
            $data['status'] = 1;
            $data['employee'] = $id;
            if('thisUserIsASuperAdmin'){
                $data['status'] = 3;
                $data['approved_by'] = Auth::Id();
                $data['approved_at'] = now();
                }
            EmployeeFamily::create($data);

            return redirect()->route('employee_families.employee_family.index', $employee)
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
    public function approve($employee, $employeeFamilies)
    {
        try {

            $employeeFamily = EmployeeFamily::findOrFail($employeeFamilies);
            $employeeFamily->status = 3;
            $employeeFamily->approved_by = Auth::Id();
            $employeeFamily->approved_at = now();
            $employeeFamily->save();

            return redirect()->route('employee_families.employee_family.index',$employee)
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
    public function reject($employee, $employeeFamilies, Request $request)
    {
        try {

            $employeeFamily = EmployeeFamily::findOrFail($employeeFamilies);
            $employeeFamily->status = 2;
            $employeeFamily->note = $request['note'];
            $employeeFamily->save();

            return redirect()->route('employee_families.employee_family.index',$employee)
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
    public function edit($employee, $employeeFamilies)
    {
        $employee = Employee::findOrFail($employee);
        $employeeFamily = EmployeeFamily::findOrFail($employeeFamilies);
        $sexes = Sex::pluck('name', 'id')->all();
        $relationships = Relationship::pluck('name', 'id')->all();

        return view('employees.family.edit', compact('employeeFamily', 'employee', 'sexes', 'relationships'));
    }

        //Prints employee family
        public function print($employee)
        {
            $employee_id = $employee;
            $employee = Employee::findOrFail($employee_id);
            $employeeFamilies = EmployeeFamily::where('employee', $employee_id)->with('employees','relationships','sexes')->get();

            return view('employees.family.print', compact('employeeFamilies','employee'));
        }

    /**
     * Update the specified employee family in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeFamilies, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeFamily = EmployeeFamily::findOrFail($employeeFamilies);
            $data['employee'] = $employee;
            $employeeFamily->update($data);

            return redirect()->route('employee_families.employee_family.index',$employee)
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
    public function destroy($employee, $employeeFamilies)
    {
        try {
            $employeeFamily = EmployeeFamily::findOrFail($employeeFamilies);
            $employeeFamily->delete();

            return redirect()->route('employee_families.employee_family.index',$employee)
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

        if (!file_exists('uploads/family'))
        {
            mkdir('uploads/family', 0777 , true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/family', $fileName);
        
        return $fileName;
    }
}
