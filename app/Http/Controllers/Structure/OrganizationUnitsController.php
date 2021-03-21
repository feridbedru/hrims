<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\JobCategory;
use App\Models\JobTitleCategory;
use App\Models\JobPosition;
use App\Models\Organization;
use App\Models\OrganizationLocation;
use App\Models\OrganizationUnit;
use App\Models\User;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class OrganizationUnitsController extends Controller
{

    /**
     * Display a listing of the organization units.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $organizationUnits = OrganizationUnit::with('chairman', 'jobCategorys', 'locations')->paginate(25);
        $jobCategories = JobCategory::pluck('name', 'id')->all();
        $organizationLocations = OrganizationLocation::pluck('name', 'id')->all();
        $organizations = Organization::all();

        return view('structure.organization_units.index', compact('organizationUnits', 'jobCategories', 'organizationLocations', 'organizations'));
    }

    /**
     * FIlter a listing of the organization units.
     *
     * @return Illuminate\View\View
     */
    public function filter(Request $request, OrganizationUnit $organizationUnits)
    {
        $organizationUnits = $organizationUnits->newQuery();
        if ($request->has('job_category_id')) {
            $organizationUnits->where('job_category_id', $request->input('job_category_id'));
        }
        if ($request->has('organization_location_id')) {
            $organizationUnits->where('organization_location_id', $request->input('organization_location_id'));
        }
        if ($request->has('organization_unit_name')) {
            $organizationUnits->orWhere('en_name', 'like', '%' . $request->input('organization_unit_name') . '%')
                ->orWhere('am_name', 'like', '%' . $request->input('organization_unit_name') . '%')
                ->orWhere('am_acronym', 'like', '%' . $request->input('organization_unit_name') . '%')
                ->orWhere('en_acronym', 'like', '%' . $request->input('organization_unit_name') . '%');
        }
        $jobCategories = JobCategory::pluck('name', 'id')->all();
        $organizationLocations = OrganizationLocation::pluck('name', 'id')->all();
        $organizationUnits = $organizationUnits->paginate(25);

        return view('structure.organization_units.index', compact('organizationUnits', 'jobCategories', 'organizationLocations'));
    }

    // A function that will display all the employees in each unit of organization

    public function employees($id)
    {
        $employees = Employee::where('organization_unit', $id)->paginate(25);
        $jobTitleCategories = JobTitleCategory::all();

        return view('structure.organization_units.employees', compact('employees','jobTitleCategories'));
    }


    //  A function that will display all the jobs in each unit of organization

    public function jobs($id)
    {

        $jobs = JobPosition::where('organization_unit', $id)->paginate(25);

        return view('structure.organization_units.jobs', compact('jobs'));
    }

    // A function that will display all the offices of each unit in the organization

    public function offices($id)
    {
        $units = OrganizationUnit::where('parent',$id)->with('chairman', 'jobCategorys', 'locations', 'parents', 'reportsTo')->paginate(25);

        return view('structure.organization_units.offices', compact('units'));
    }

    /**
     * Show the form for creating a new organization unit.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobCategories = JobCategory::pluck('name', 'id')->all();
        $organizationLocations = OrganizationLocation::pluck('name', 'id')->all();
        $chairmans = User::pluck('name', 'id')->all();
        $organizations = Organization::all();

        return view('structure.organization_units.create', compact('organizationUnits', 'jobCategories', 'organizationLocations', 'chairmans', 'organizations'));
    }

    /**
     * Store a new organization unit in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            OrganizationUnit::create($data);

            return redirect()->route('organization_units.organization_unit.index')
                ->with('success_message', 'Organization Unit was successfully added.');
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
     * Display the specified organization unit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $organizationUnit = OrganizationUnit::with('chairman', 'jobCategorys', 'locations', 'parents', 'reportsTo')->findOrFail($id);

        return view('structure.organization_units.show', compact('organizationUnit'));
    }

    /**
     * Show the form for editing the specified organization unit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $organizationUnit = OrganizationUnit::findOrFail($id);
        $organizationUnits = OrganizationUnit::pluck('en_name', 'id')->all();
        $jobCategories = JobCategory::pluck('name', 'id')->all();
        $organizationLocations = OrganizationLocation::pluck('name', 'id')->all();
        $chairmans = User::pluck('name', 'id')->all();

        return view('structure.organization_units.edit', compact('organizationUnit', 'organizationUnits', 'jobCategories', 'organizationLocations', 'chairmans'));
    }

    /**
     * Update the specified organization unit in the storage.
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

            $organizationUnit = OrganizationUnit::findOrFail($id);
            $organizationUnit->update($data);

            return redirect()->route('organization_units.organization_unit.index')
                ->with('success_message', 'Organization Unit was successfully updated.');
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
     * Remove the specified organization unit from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $organizationUnit = OrganizationUnit::findOrFail($id);
            $organizationUnit->delete();

            return redirect()->route('organization_units.organization_unit.index')
                ->with('success_message', 'Organization Unit was successfully deleted.');
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
            'en_acronym' => 'string|min:1|nullable',
            'am_name' => 'string|min:1|nullable',
            'am_acronym' => 'string|min:1|nullable',
            'parent' => 'nullable',
            'reports_to' => 'nullable',
            'job_category' => 'required',
            'location' => 'required',
            'is_root_unit' => 'boolean|nullable',
            'is_category' => 'boolean|nullable',
            'phone_number' => 'numeric|nullable',
            'email_address' => 'nullable',
            'web_page' => 'string|nullable',
        ];

        $data = $request->validate($rules);

        $data['is_root_unit'] = $request->has('is_root_unit');
        $data['is_category'] = $request->has('is_category');

        return $data;
    }
}
