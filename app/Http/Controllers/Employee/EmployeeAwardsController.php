<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\AwardType;
use App\Models\Employee;
use App\Models\EmployeeAward;
use App\Models\User;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use Exception;

class EmployeeAwardsController extends Controller
{

    /**
     * Display a listing of the employee awards.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeAwards = DB::table('employee_awards')
            ->join('employees', 'employee_awards.employee', '=', 'employees.id')
            ->join('award_types', 'employee_awards.type', '=', 'award_types.id')
            ->select('employee_awards.*', 'employees.en_name', 'award_types.name as type')
            ->paginate(25);

        return view('employees.award.index', compact('employeeAwards'));
    }

    /**
     * Show the form for creating a new employee award.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $awardTypes = AwardType::pluck('name', 'id')->all();
        $creators = User::pluck('name', 'id')->all();
        $approvedBies = User::pluck('name', 'id')->all();

        return view('employees.award.create', compact('employees', 'awardTypes', 'creators', 'approvedBies'));
    }

    /**
     * Store a new employee award in the storage.
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
            EmployeeAward::create($data);

            return redirect()->route('employee_awards.employee_award.index')
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
     * Display the specified employee award.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeAward = EmployeeAward::with('employee', 'awardtype', 'creator', 'approvedby')->findOrFail($id);

        return view('employees.award.show', compact('employeeAward'));
    }

    /**
     * Show the form for editing the specified employee award.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeAward = EmployeeAward::findOrFail($id);
        $employees = Employee::pluck('en_name', 'id')->all();
        $awardTypes = AwardType::pluck('name', 'id')->all();
        $creators = User::pluck('name', 'id')->all();
        $approvedBies = User::pluck('name', 'id')->all();

        return view('employees.award.edit', compact('employeeAward', 'employees', 'awardTypes', 'creators', 'approvedBies'));
    }

    /**
     * Update the specified employee award in the storage.
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

            $employeeAward = EmployeeAward::findOrFail($id);
            $employeeAward->update($data);

            return redirect()->route('employee_awards.employee_award.index')
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
    public function destroy($id)
    {
        try {
            $employeeAward = EmployeeAward::findOrFail($id);
            $employeeAward->delete();

            return redirect()->route('employee_awards.employee_award.index')
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
            'employee' => 'required',
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

        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
