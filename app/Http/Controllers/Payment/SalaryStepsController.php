<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\SalaryScale;
use App\Models\SalaryStep;
use Illuminate\Http\Request;
use Exception;

class SalaryStepsController extends Controller
{

    /**
     * Display a listing of the salary steps.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $salarySteps = SalaryStep::with('salaryscale')->paginate(25);

        return view('payment.salary_steps.index', compact('salarySteps'));
    }

    /**
     * Show the form for creating a new salary step.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $salaryScales = SalaryScale::pluck('name','id')->all();
        
        return view('payment.salary_steps.create', compact('salaryScales'));
    }

    /**
     * Store a new salary step in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SalaryStep::create($data);

            return redirect()->route('salary_steps.salary_step.index')
                ->with('success_message', 'Salary Step was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified salary step.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $salaryStep = SalaryStep::with('salaryscale')->findOrFail($id);

        return view('payment.salary_steps.show', compact('salaryStep'));
    }

    /**
     * Show the form for editing the specified salary step.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $salaryStep = SalaryStep::findOrFail($id);
        $salaryScales = SalaryScale::pluck('name','id')->all();

        return view('payment.salary_steps.edit', compact('salaryStep','salaryScales'));
    }

    /**
     * Update the specified salary step in the storage.
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
            
            $salaryStep = SalaryStep::findOrFail($id);
            $salaryStep->update($data);

            return redirect()->route('salary_steps.salary_step.index')
                ->with('success_message', 'Salary Step was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified salary step from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $salaryStep = SalaryStep::findOrFail($id);
            $salaryStep->delete();

            return redirect()->route('salary_steps.salary_step.index')
                ->with('success_message', 'Salary Step was successfully deleted.');
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
                'salary_scale' => 'required',
            'step' => 'numeric|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
