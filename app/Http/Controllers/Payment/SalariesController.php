<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\SalaryHeight;
use App\Models\SalaryStep;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
        $salaries = Salary::with('salaryHeights', 'salarySteps')->paginate(25);

        return view('payment.salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new salary.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $salaryHeights = SalaryHeight::pluck('level', 'id')->all();
        $salarySteps = SalaryStep::pluck('step', 'id')->all();

        return view('payment.salaries.create', compact('salaryHeights', 'salarySteps'));
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
     * Display the specified salary.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $salary = Salary::with('salaryHeights', 'salarySteps')->findOrFail($id);

        return view('payment.salaries.show', compact('salary'));
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
        $salaryHeights = SalaryHeight::pluck('level', 'id')->all();
        $salarySteps = SalaryStep::pluck('step', 'id')->all();

        return view('payment.salaries.edit', compact('salary', 'salaryHeights', 'salarySteps'));
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
            'salary_height' => 'required',
            'salary_step' => 'required',
            'amount' => 'required|string|min:1',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
