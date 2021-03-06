<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\AwardType;
use App\Models\Employee;
use App\Models\EmployeeAward;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Andegna\DateTime;
use Exception;

class EmployeeAwardsController extends Controller
{

    /**
     * Display a listing of the employee awards.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeAwards = EmployeeAward::where('employee', $employee_id)->with('types', 'employees')->paginate(25);

        return view('employees.award.index', compact('employeeAwards', 'employee'));
    }

    /**
     * Show the form for creating a new employee award.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $awardTypes = AwardType::pluck('name', 'id')->all();

        return view('employees.award.create', compact('employee', 'awardTypes'));
    }

    /**
     * Store a new employee award in the storage.
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
            $data['created_by'] = Auth::Id();
            $data['status'] = 1;
            $data['employee'] = $id;
            if ('thisUserIsASuperAdmin') {
                $data['status'] = 3;
                $data['approved_by'] = Auth::Id();
                $data['approved_at'] = now();
            }
            EmployeeAward::create($data);

            return redirect()->route('employee_awards.employee_award.index', $employee)
                ->with('success_message', 'Employee Award was successfully added.');
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
     * Approve the specified employee certification
     *
     * @param int $id
     */
    public function approve($employee, $employeeAwards)
    {
        try {

            $employeeAward = EmployeeAward::findOrFail($employeeAwards);
            $employeeAward->status = 3;
            $employeeAward->approved_by = Auth::Id();
            $employeeAward->approved_at = now();
            $employeeAward->save();

            return redirect()->route('employee_awards.employee_award.show', ['employee' => $employee, 'employeeAward' => $employeeAward])
                ->with('success_message', 'Employee Award was successfully approved.');
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
     * reject the specified employee certification
     *
     * @param int $id
     */
    public function reject($employee, $employeeAwards, Request $request)
    {
        try {

            $employeeAward = EmployeeAward::findOrFail($employeeAwards);
            $employeeAward->status = 2;
            $employeeAward->note = $request['note'];
            $employeeAward->save();

            return redirect()->route('employee_awards.employee_award.show', ['employee' => $employee, 'employeeAward' => $employeeAward])
                ->with('success_message', 'Employee Award was successfully rejected.');
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
     * Display the specified employee award.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($employee, $employeeAwards)
    {
        $employee = Employee::findOrFail($employee);
        $employeeAward = EmployeeAward::with('employees', 'types')->findOrFail($employeeAwards);

        return view('employees.award.show', compact('employeeAward', 'employee'));
    }

    /**
     * Show the form for editing the specified employee award.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeAwards)
    {
        $employee = Employee::findOrFail($employee);
        $employeeAward = EmployeeAward::findOrFail($employeeAwards);
        $awardTypes = AwardType::pluck('name', 'id')->all();

        return view('employees.award.edit', compact('employeeAward', 'employee', 'awardTypes'));
    }

    //Prints employee award
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeAwards = EmployeeAward::where('employee', $employee_id)->with('types', 'employees')->get();

        return view('employees.award.print', compact('employeeAwards', 'employee'));
    }

    /**
     * Update the specified employee award in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeAwards, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeAward = EmployeeAward::findOrFail($employeeAwards);
            $data['employee'] = $employee;
            $employeeAward->update($data);

            return redirect()->route('employee_awards.employee_award.index', $employee)
                ->with('success_message', 'Employee Award was successfully updated.');
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
     * Remove the specified employee award from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeAwards)
    {
        try {
            $employeeAward = EmployeeAward::findOrFail($employeeAwards);
            $employeeAward->delete();

            return redirect()->route('employee_awards.employee_award.index', $employee)
                ->with('success_message', 'Employee Award was successfully deleted.');
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
            'organization' => 'required|string|min:1',
            'description' => 'string|min:1|max:1000|nullable',
            'attachment' => ['file'],
            'type' => 'required',
            'awarded_on' => 'nullable|string|min:0',
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
            'note' => 'string|min:1|max:1000|nullable',
        ];
        if ($request->route()->getAction()['as'] == 'employee_awards.employeeaward.store' || $request->has('custom_delete_attachment')) {
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

        if (!file_exists('uploads/awards')) {
            mkdir('uploads/awards', 0777, true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/awards', $fileName);

        return $fileName;
    }
}
