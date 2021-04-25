<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAdditionalInfo;
use App\Models\EmployeeAddress;
use App\Models\EmployeeAdministrativePunishment;
use App\Models\EmployeeAward;
use App\Models\EmployeeBankAccount;
use App\Models\EmployeeCertification;
use App\Models\EmployeeDisability;
use App\Models\EmployeeDisaster;
use App\Models\EmployeeEducation;
use App\Models\EmployeeEmergency;
use App\Models\EmployeeExperience;
use App\Models\EmployeeFamily;
use App\Models\EmployeeFile;
use App\Models\EmployeeJudiciaryPunishment;
use App\Models\EmployeeLanguage;
use App\Models\EmployeeLicense;
use App\Models\EmployeeStudyTraining;
use App\Models\EmployeeStatus;
use App\Models\JobPosition;
use App\Models\JobTitleCategory;
use App\Models\OrganizationUnit;
use App\Models\User;
use App\Models\Sex;
use App\Models\Title;
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
        $employees = Employee::with('titles', 'sexes', 'organizationUnitse', 'jobPositions', 'employeeStatuses')->paginate(25);
        $jobPositions = JobPosition::pluck('job_title_category', 'id');
        $sexl = Sex::pluck('name', 'id');
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobTitleCategories = JobTitleCategory::all();

        return view('employees.index', compact('employees', 'jobPositions', 'organizationUnits', 'sexl', 'jobTitleCategories'));
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
        $jobPositions = JobPosition::where('status', '1')->pluck('position_code', 'id')->all();
        $employeeStatuses = EmployeeStatus::pluck('name', 'id')->all();

        return view('employees.create', compact('titles', 'sexes', 'organizationUnits', 'jobPositions', 'employeeStatuses'));
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
            $data['created_by'] = 1;
            $full_name = $data['en_name'];
            $success = Employee::create($data);
            $employee_id = DB::getPdo()->lastInsertId();
            $password = $this->randomPassword();
            $username = $this->makeUsername($full_name);
            $domain = "";
            $website = DB::table('organizations')->whereNotNull('website')->pluck('website')->first();
            if($website){
                $domain = '@'.$website;
            }
            $user = new User();
            $user->name = $username;
            $user->password = bcrypt($password);
            $user->employee = $employee_id;
            $user->email = $username.$domain;
            $user->save();

            if ($success) {
                // dd($data['job_position']);
                $position_id = $data['job_position'];
                $jobPosition = JobPosition::findOrFail($position_id);
                $jobPosition->status = 0;
                $jobPosition->save();
            }
            $employee = Employee::with('titles', 'sexes', 'organizationUnitse', 'jobPositions', 'employeeStatuses')->findOrFail($employee_id);
            return view('employees.success', compact('employee','password'));
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
     * generates random password
     *
     */
    private function randomPassword()
    {
        $alphabet = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnPpQqRrSsTtUuVvWwXxYyZz1234567890!@#$%^&*().?';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);
        return $password; 
    }


    /**
     * generates username
     *
     */
    private function makeUsername($fullname)
    {
        $fullname = strtolower($fullname);
        $name = explode(' ',$fullname);
        $firstname=$name[0];
        $middlename=$name[1];

        $username = $firstname.'.'.$middlename;
        $verify = $this->checkUsername($username);
        if($verify == TRUE){
            $numbers="0123456789";
            $number=str_shuffle($numbers);
            $ids=substr($number,0,2);
            $username = $username.$ids;
            return $username;
        }
        else{
            return $username;
        }
    }


    /**
     * checks if a username exists
     *
     */
    private function checkUsername($name)
    {
        $username = User::where('name','=', $name)->first();
        if($username === null){
            return false;
        }
        else{
            return true;
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
        $employee = Employee::with('titles', 'sexes', 'organizationUnitse', 'jobPositions', 'employeeStatuses')->findOrFail($id);
        $jobTitleCategories = JobTitleCategory::all();

        return view('employees.dashboard', compact('employee', 'jobTitleCategories'));
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
        $employee = Employee::with('title', 'sex', 'organizationunit', 'jobposition', 'employeestatus')->findOrFail($id);

        return view('employees.success', compact('employee'));
    }

    //Prints employee all data
    public function printall($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeAdditionalInfos = EmployeeAdditionalInfo::with('employees', 'nationalities', 'religions', 'maritalStatuses')->get();
        $employeeAddresses = EmployeeAddress::where('employee', $employee_id)->with('employees', 'types', 'woredas')->get();
        $employeeAdministrativePunishments = EmployeeAdministrativePunishment::where('employee', $employee_id)->with('employees')->get();
        $employeeAwards = EmployeeAward::where('employee', $employee_id)->with('types', 'employees')->get();
        $employeeBankAccounts = EmployeeBankAccount::where('employee', $employee_id)->with('banks', 'types', 'employees')->get();
        $employeeCertifications = EmployeeCertification::where('employee', $employee_id)->with('employees', 'vendors', 'categories')->get();
        $employeeDisabilities = EmployeeDisability::where('employee', $employee_id)->with('employees', 'types')->get();
        $employeeDisasters = EmployeeDisaster::where('employee', $employee_id)->with('causes', 'employees', 'severities')->get();
        $employeeEducations = EmployeeEducation::where('employee', $employee_id)->with('employees', 'levels', 'institutes', 'fields', 'gpaScales')->get();
        $employeeEmergencies = EmployeeEmergency::where('employee', $employee_id)->with('employees', 'relationships')->get();
        $employeeExperiences = EmployeeExperience::where('employee', $employee_id)->with('employees', 'types', 'leftReasons')->get();
        $employeeFamilies = EmployeeFamily::where('employee', $employee_id)->with('employees', 'relationships', 'sexes')->get();
        $employeeFiles = EmployeeFile::where('employee', $employee_id)->with('employees')->get();
        $employeeJudiciaryPunishments = EmployeeJudiciaryPunishment::where('employee', $employee_id)->with('employees')->get();
        $employeeLanguages = EmployeeLanguage::where('employee', $employee_id)->with('employees', 'languages', 'readings', 'writings', 'speakings', 'listenings')->get();
        $employeeLicenses = EmployeeLicense::where('employee', $employee_id)->with('employees', 'types')->get();
        $employeeStudyTrainings = EmployeeStudyTraining::where('employee', $employee_id)->with('employees', 'types', 'institutions', 'fields', 'levels')->get();

        return view('employees.printall', compact('employee', 'employeeAdditionalInfos', 'employeeAddresses', 'employeeAdministrativePunishments', 'employeeAwards', 'employeeBankAccounts', 'employeeCertifications', 'employeeDisabilities', 'employeeDisasters', 'employeeEducations', 'employeeEmergencies', 'employeeExperiences', 'employeeFamilies', 'employeeFiles', 'employeeJudiciaryPunishments', 'employeeLanguages', 'employeeLicenses', 'employeeStudyTrainings'));
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

        return view('employees.edit', compact('employee', 'titles', 'sexes', 'organizationUnits', 'jobPositions', 'employeeStatuses'));
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
            'created_by' => 'nullable',
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

        if (!file_exists('uploads/photo')) {
            mkdir('uploads/photo', 0777, true);
        }
        $fileName = sprintf('%s.%s', uniqid(), $file->getClientOriginalExtension());
        $path = $file->move('uploads/photo', $fileName);

        return $fileName;
    }
}
