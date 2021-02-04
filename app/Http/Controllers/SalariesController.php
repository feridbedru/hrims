<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\SalaryHeight;
use App\Models\SalaryStep;
use Illuminate\Http\Request;
use Exception;

class SalariesController extends Controller
{

    /**
     * Display a listing of the salaries.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $salaries = Salary::with('salaryheight','salarystep')->paginate(25);

        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new salary.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $salaryHeights = SalaryHeight::pluck('created_at','id')->all();
$salarySteps = SalaryStep::pluck('created_at','id')->all();
        
        return view('salaries.create', compact('salaryHeights','salarySteps'));
    }

    /**
     * Store a new salary in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Salary::create($data);

            return redirect()->route('salaries.salary.index')
                ->with('success_message', 'Salary was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified salary.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $salary = Salary::with('salaryheight','salarystep')->findOrFail($id);

        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified salary.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        $salaryHeights = SalaryHeight::pluck('created_at','id')->all();
$salarySteps = SalaryStep::pluck('created_at','id')->all();

        return view('salaries.edit', compact('salary','salaryHeights','salarySteps'));
    }

    /**
     * Update the specified salary in the storage.
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
            
            $salary = Salary::findOrFail($id);
            $salary->update($data);

            return redirect()->route('salaries.salary.index')
                ->with('success_message', 'Salary was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified salary from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $salary = Salary::findOrFail($id);
            $salary->delete();

            return redirect()->route('salaries.salary.index')
                ->with('success_message', 'Salary was successfully deleted.');
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
                'salary_height' => 'required',
            'salary_step' => 'required',
            'amount' => 'required|string|min:1', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
