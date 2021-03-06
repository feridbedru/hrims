<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Models\Salary;
use App\Models\SalaryHeight;
use App\Models\SalaryScale;
use App\Models\SalaryStep;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DB;
use Exception;

class SalaryScalesController extends Controller
{

    /**
     * Display a listing of the salary scales.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $salaryScales = SalaryScale::with('jobCategories')->paginate(25);

        return view('payment.salary_scales.index', compact('salaryScales'));
    }

    /**
     * Show the form for creating a new salary scale.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $jobCategories = JobCategory::pluck('name', 'id')->all();

        return view('payment.salary_scales.create', compact('jobCategories'));
    }

    /**
     * Store a new salary scale in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            $steps = $request['salary_steps'];

            SalaryScale::create($data);
            try {
                $salaryScale = DB::getPdo()->lastInsertId();
                for ($i = 1; $i <= $steps; $i++) {
                    $salaryStep = new SalaryStep();
                    $salaryStep->salary_scale = $salaryScale;
                    $salaryStep->step = $i;
                    $salaryStep->save();
                }

                return redirect()->route('salary_scales.salary_scale.index')
                    ->with('success_message', 'Salary Scale was successfully added.');
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
     * Display the specified salary scale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $salaryScale = SalaryScale::with('jobCategories')->findOrFail($id);
        $salaryHeights = SalaryHeight::where('salary_scale',$id)->get();
        $salaries = Salary::all();

        return view('payment.salary_scales.show', compact('salaryScale','salaryHeights','salaries'));
    }

    /**
     * Show the form for editing the specified salary scale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $salaryScale = SalaryScale::findOrFail($id);
        $jobCategories = JobCategory::pluck('name', 'id')->all();

        return view('payment.salary_scales.edit', compact('salaryScale', 'jobCategories'));
    }

    /**
     * Update the specified salary scale in the storage.
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

            $salaryScale = SalaryScale::findOrFail($id);
            try {
                $steps = $request['salary_steps'];
                try {
                    SalaryStep::where('salary_scale', $id)->delete();
                    for ($i = 1; $i <= $steps; $i++) {
                        $salaryStep = new SalaryStep();
                        $salaryStep->salary_scale = $id;
                        $salaryStep->step = $i;
                        $salaryStep->save();
                    }
                    $salaryScale->update($data);
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

            return redirect()->route('salary_scales.salary_scale.index')
                ->with('success_message', 'Salary Scale was successfully updated.');
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
     * Remove the specified salary scale from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $salaryScale = SalaryScale::findOrFail($id);
            $salaryScale->delete();

            return redirect()->route('salary_scales.salary_scale.index')
                ->with('success_message', 'Salary Scale was successfully deleted.');
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
            'name' => 'required|string|min:1|max:255',
            'description' => 'required|string|min:1|max:255',
            'job_category' => 'required',
            'stair_height' => 'required|numeric|min:1',
            'salary_steps' => 'required|numeric|min:1',
            'is_enabled' => 'boolean|nullable',
        ];

        $data = $request->validate($rules);

        $data['is_enabled'] = $request->has('is_enabled');

        return $data;
    }
}
