<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLanguage;
use App\Models\Language;
use App\Models\LanguageLevel;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use Exception;

class EmployeeLanguagesController extends Controller
{

    /**
     * Display a listing of the employee languages.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeLanguages = EmployeeLanguage::where('employee', $employee_id)->with('employees', 'languages', 'readings', 'writings', 'speakings', 'listenings')->paginate(25);

        return view('employees.language.index', compact('employeeLanguages', 'employee'));
    }

    /**
     * Show the form for creating a new employee language.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $languages = Language::pluck('name', 'id')->all();
        $languageLevels = LanguageLevel::pluck('name', 'id')->all();

        return view('employees.language.create', compact('employee', 'languages', 'languageLevels'));
    }

    /**
     * Store a new employee language in the storage.
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
            $data['employee'] = $id;
            EmployeeLanguage::create($data);

            return redirect()->route('employee_languages.employee_language.index', $employee)
                ->with('success_message', 'Employee Language was successfully added.');
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
     * Show the form for editing the specified employee language.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeLanguages)
    {
        $employee = Employee::findOrFail($employee);
        $employeeLanguage = EmployeeLanguage::findOrFail($employeeLanguages);
        $languages = Language::pluck('name', 'id')->all();
        $languageLevels = LanguageLevel::pluck('name', 'id')->all();

        return view('employees.language.edit', compact('employeeLanguage', 'employee', 'languages', 'languageLevels'));
    }

    //Prints employee language
    public function print($employee)
    {
        $employee_id = $employee;
        $employee = Employee::findOrFail($employee_id);
        $employeeLanguages = EmployeeLanguage::where('employee', $employee_id)->with('employees', 'languages', 'readings', 'writings', 'speakings', 'listenings')->get();

        return view('employees.language.print', compact('employeeLanguages', 'employee'));
    }

    /**
     * Update the specified employee language in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeLanguages, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeLanguage = EmployeeLanguage::findOrFail($employeeLanguages);
            $data['employee'] = $employee;
            $employeeLanguage->update($data);

            return redirect()->route('employee_languages.employee_language.index', $employee)
                ->with('success_message', 'Employee Language was successfully updated.');
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
     * Remove the specified employee language from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeLanguages)
    {
        try {
            $employeeLanguage = EmployeeLanguage::findOrFail($employeeLanguages);
            $employeeLanguage->delete();

            return redirect()->route('employee_languages.employee_language.index', $employee)
                ->with('success_message', 'Employee Language was successfully deleted.');
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
            'language' => 'required|numeric|min:0|max:4294967295',
            'reading' => 'required|numeric|min:0|max:4294967295',
            'writing' => 'required|numeric|min:0|max:4294967295',
            'listening' => 'required|numeric|min:0|max:4294967295',
            'speaking' => 'required|numeric|min:0|max:4294967295',
            'is_prefered' => 'boolean|nullable',
            'created_by' => 'nullable',
        ];

        $data = $request->validate($rules);

        $data['is_prefered'] = $request->has('is_prefered');

        return $data;
    }
}
