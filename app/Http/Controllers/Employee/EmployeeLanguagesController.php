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
    public function index()
    {
        $employeeLanguages = EmployeeLanguage::with('employees', 'languages', 'languageLevels')->paginate(25);

        return view('employees.language.index', compact('employeeLanguages'));
    }

    /**
     * Show the form for creating a new employee language.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();
        $languageLevels = LanguageLevel::pluck('name', 'id')->all();

        return view('employees.language.create', compact('employees', 'languages', 'languageLevels'));
    }

    /**
     * Store a new employee language in the storage.
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
            EmployeeLanguage::create($data);

            return redirect()->route('employee_languages.employee_language.index')
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
    public function edit($id)
    {
        $employeeLanguage = EmployeeLanguage::findOrFail($id);
        $employees = Employee::pluck('en_name', 'id')->all();
        $languages = Language::pluck('name', 'id')->all();
        $languageLevels = LanguageLevel::pluck('name', 'id')->all();

        return view('employees.language.edit', compact('employeeLanguage', 'employees', 'languages', 'languageLevels'));
    }

    /**
     * Update the specified employee language in the storage.
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

            $employeeLanguage = EmployeeLanguage::findOrFail($id);
            $employeeLanguage->update($data);

            return redirect()->route('employee_languages.employee_language.index')
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
    public function destroy($id)
    {
        try {
            $employeeLanguage = EmployeeLanguage::findOrFail($id);
            $employeeLanguage->delete();

            return redirect()->route('employee_languages.employee_language.index')
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
            'employee' => 'required',
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
