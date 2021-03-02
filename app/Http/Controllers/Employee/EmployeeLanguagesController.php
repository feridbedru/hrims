<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLanguage;
use App\Models\Language;
use App\Models\LanguageLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $employeeLanguages = EmployeeLanguage::with('employee','language','languagelevel','languagelevel','languagelevel','languagelevel','creator')->paginate(25);
        $employeeLanguages = DB::table('employee_languages')
        ->join('employees','employee_languages.employee','=','employees.id')
        ->join('languages','employee_languages.language','=','languages.id')
        ->join('language_levels','employee_languages.reading','=','language_levels.id')
        // ->join('language_levels','employee_languages.writing','=','language_levels.id')
        // ->join('language_levels','employee_languages.speaking','=','languagelevels.id')
        // ->join('language_levels','employee_languages.listening','=','languagelevels.id')
        ->select('employee_languages.*','employees.en_name','language_levels.name as level','languages.name as language')
        ->paginate(25);
        return view('employees.language.index', compact('employeeLanguages'));
    }

    /**
     * Show the form for creating a new employee language.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $languages = Language::pluck('name','id')->all();
        $languageLevels = LanguageLevel::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        
        return view('employees.language.create', compact('employees','languages','languageLevels','languageLevels','languageLevels','languageLevels','creators'));
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

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee language.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $employeeLanguage = EmployeeLanguage::with('employee','language','languagelevel','languagelevel','languagelevel','languagelevel','creator')->findOrFail($id);

        return view('employees.language.show', compact('employeeLanguage'));
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
        $employees = Employee::pluck('en_name','id')->all();
        $languages = Language::pluck('name','id')->all();
        $languageLevels = LanguageLevel::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();

        return view('employees.language.edit', compact('employeeLanguage','employees','languages','languageLevels','languageLevels','languageLevels','languageLevels','creators'));
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
