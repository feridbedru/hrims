<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\EvaluationType;
use App\Models\JobCategory;
use App\Models\OrganizationUnit;
use Illuminate\Http\Request;
use Exception;

class EvaluationsController extends Controller
{

    /**
     * Display a listing of the evaluations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $evaluations = Evaluation::with('evaluationtype','jobcategory','organizationunit')->paginate(25);

        return view('evaluation.evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new evaluation.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $evaluationTypes = EvaluationType::pluck('name','id')->all();
        $jobCategories = JobCategory::pluck('name','id')->all();
        $organizationUnits = OrganizationUnit::pluck('am_acronym','id')->all();
        
        return view('evaluation.evaluations.create', compact('evaluationTypes','jobCategories','organizationUnits'));
    }

    /**
     * Store a new evaluation in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Evaluation::create($data);

            return redirect()->route('evaluations.evaluation.index')
                ->with('success_message', 'Evaluation was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified evaluation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $evaluation = Evaluation::with('evaluationtype','jobcategory','organizationunit')->findOrFail($id);

        return view('evaluation.evaluations.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified evaluation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluationTypes = EvaluationType::pluck('name','id')->all();
        $jobCategories = JobCategory::pluck('name','id')->all();
        $organizationUnits = OrganizationUnit::pluck('am_acronym','id')->all();

        return view('evaluation.evaluations.edit', compact('evaluation','evaluationTypes','jobCategories','organizationUnits'));
    }

    /**
     * Update the specified evaluation in the storage.
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
            
            $evaluation = Evaluation::findOrFail($id);
            $evaluation->update($data);

            return redirect()->route('evaluations.evaluation.index')
                ->with('success_message', 'Evaluation was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified evaluation from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $evaluation = Evaluation::findOrFail($id);
            $evaluation->delete();

            return redirect()->route('evaluations.evaluation.index')
                ->with('success_message', 'Evaluation was successfully deleted.');
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
                'title' => 'required|string|min:1|max:255',
                'description' => 'string|min:1|max:1000|nullable',
                'time_period' => 'required|string|min:1',
                'start_date' => 'required',
                'end_date' => 'required',
                'evaluation_type_id' => 'required',
                'job_category_id' => 'required',
                'organization_units_id' => 'required',
                'self' => 'required',
                'peer' => 'required',
                'team_leader' => 'required',
                'unit_leader' => 'required',
                'status' => 'required', 
        ];
        
        $data = $request->validate($rules);

        return $data;
    }

}
