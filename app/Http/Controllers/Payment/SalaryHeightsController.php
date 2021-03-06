<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\SalaryHeight;
use App\Models\SalaryScale;
use App\Models\SalaryStep;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class SalaryHeightsController extends Controller
{

    /**
     * Display a listing of the salary heights.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $salaryHeights = SalaryHeight::with('salaryScales')->paginate(25);

        return view('payment.salary_heights.index', compact('salaryHeights'));
    }

    /**
     * Show the form for creating a new salary height.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $salaryScales = SalaryScale::pluck('name', 'id')->all();

        return view('payment.salary_heights.create', compact('salaryScales'));
    }

    /**
     * Store a new salary height in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            SalaryHeight::create($data);

            return redirect()->route('salary_heights.salary_height.index')
                ->with('success_message', 'Salary Height was successfully added.');
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
     * Display the specified salary height.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $salaryHeight = SalaryHeight::with('salaryScales')->findOrFail($id);
        $scale_id = $salaryHeight->salaryScales->salary_step;
        $scale = $salaryHeight->salaryScales->id;
        $salary_steps = SalaryStep::where('salary_scale', $scale)->get();
        $salaries = Salary::where('salary_height', $id)->get();

        return view('payment.salary_heights.show', compact('salaryHeight', 'scale_id', 'salary_steps', 'salaries'));
    }

    /**
     * Show the form for editing the specified salary height.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $salaryHeight = SalaryHeight::findOrFail($id);
        $salaryScales = SalaryScale::pluck('name', 'id')->all();

        return view('payment.salary_heights.edit', compact('salaryHeight', 'salaryScales'));
    }

    /**
     * Set salary for each step of the level
     * 
     */
    public function addsalary(Request $request)
    {
        try {
            $height = $request['height'];
            $stepcount = $request['stepcount'];
            $j = 0;
            for ($i = 1; $i <= $stepcount; $i++) {
                $salary = new Salary();
                $salary->salary_step = $request->step[$j];
                $salary->salary_height = $height;
                $salary->amount = $request->salary[$i];
                $salary->save();
                $j++;
            }

            return redirect()->route('salary_heights.salary_height.show', $height)
                ->with('success_message', 'Salary amounts was successfully added.');
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
     * Update salary for each step of the level
     * 
     */
    public function updatesalary(Request $request)
    {
        try {
            $height = $request['height'];
            Salary::where('salary_height', $height)->delete();
            try {
                $stepcount = $request['stepcount'];
                for ($i = 0; $i < $stepcount; $i++) {
                    $salary = new Salary();
                    $salary->salary_step = $request->step[$i];
                    $salary->salary_height = $height;
                    $salary->amount = $request->salary[$i];
                    $salary->save();
                }
                return redirect()->route('salary_heights.salary_height.show', $height)
                    ->with('success_message', 'Salary amounts was successfully updated.');
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
     * Remove the specified salary based on given height from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function deletesalary($id)
    {
        try {
            Salary::where('salary_height', $id)->delete();

            return redirect()->route('salary_heights.salary_height.show', $id)
                ->with('success_message', 'Salary Height was successfully deleted.');
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
     * Update the specified salary height in the storage.
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

            $salaryHeight = SalaryHeight::findOrFail($id);
            $salaryHeight->update($data);

            return redirect()->route('salary_heights.salary_height.index')
                ->with('success_message', 'Salary Height was successfully updated.');
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
     * Remove the specified salary height from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $salaryHeight = SalaryHeight::findOrFail($id);
            $salaryHeight->delete();

            return redirect()->route('salary_heights.salary_height.index')
                ->with('success_message', 'Salary Height was successfully deleted.');
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
            'salary_scale' => 'required',
            'level' => 'required|string|min:1',
            'initial_salary' => 'required|string|min:1',
            'maximum_salary' => 'required|string|min:1',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
