<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Models\JobPosition;
use App\Models\JobTitleCategory;
use App\Models\JobType;
use App\Models\OrganizationUnit;
use App\Models\Salary;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class JobPositionsController extends Controller
{

    /**
     * Display a listing of the job positions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jobPositions = JobPosition::with('organizationunit', 'jobtitlecategory', 'salary')->paginate(25);

        return view('job_positions.index', compact('jobPositions'));
    }

    /**
     * Show the form for creating a new job position.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobTitleCategories = JobTitleCategory::pluck('name', 'id')->all();
        $jobCategories = JobCategory::pluck('name', 'id')->all();
        $jobTypes = JobType::pluck('name', 'id')->all();
        $salaries = Salary::pluck('amount', 'id')->all();

        return view('job_positions.create', compact('organizationUnits', 'jobTitleCategories', 'jobCategories', 'jobTypes', 'salaries'));
    }

    /**
     * Store a new job position in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            JobPosition::create($data);

            return redirect()->route('job_positions.job_position.index')
                ->with('success_message', 'Job Position was successfully added.');
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
     * Display the specified job position.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $jobPosition = JobPosition::with('organizationunit', 'jobtitlecategory', 'jobcategory', 'jobtype', 'salary')->findOrFail($id);

        return view('job_positions.show', compact('jobPosition'));
    }

    /**
     * Show the form for editing the specified job position.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $jobPosition = JobPosition::findOrFail($id);
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobTitleCategories = JobTitleCategory::pluck('name', 'id')->all();
        $jobCategories = JobCategory::pluck('name', 'id')->all();
        $jobTypes = JobType::pluck('name', 'id')->all();
        $salaries = Salary::pluck('amount', 'id')->all();

        return view('job_positions.edit', compact('jobPosition', 'organizationUnits', 'jobTitleCategories', 'jobCategories', 'jobTypes', 'salaries'));
    }

    /**
     * Update the specified job position in the storage.
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

            $jobPosition = JobPosition::findOrFail($id);
            $jobPosition->update($data);

            return redirect()->route('job_positions.job_position.index')
                ->with('success_message', 'Job Position was successfully updated.');
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
     * Remove the specified job position from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $jobPosition = JobPosition::findOrFail($id);
            $jobPosition->delete();

            return redirect()->route('job_positions.job_position.index')
                ->with('success_message', 'Job Position was successfully deleted.');
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
            'organization_unit' => 'required',
            'job_title_category' => 'required',
            'job_category' => 'required',
            'job_type' => 'required',
            'job_description' => 'string|min:1|nullable',
            'position_code' => 'string|min:1|nullable',
            'position_id' => 'string|min:1|nullable',
            'salary' => 'required',
            'status' => 'boolean|nullable',
        ];

        $data = $request->validate($rules);

        $data['status'] = $request->has('status');

        return $data;
    }
}
