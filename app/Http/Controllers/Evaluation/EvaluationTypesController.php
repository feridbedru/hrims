<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Models\EvaluationType;
use Illuminate\Http\Request;
use Exception;

class EvaluationTypesController extends Controller
{

    /**
     * Display a listing of the evaluation types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $evaluationTypes = EvaluationType::paginate(25);

        return view('evaluation.evaluation_types.index', compact('evaluationTypes'));
    }

    /**
     * Show the form for creating a new evaluation type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        return view('evaluation.evaluation_types.create');
    }

    /**
     * Store a new evaluation type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            EvaluationType::create($data);

            return redirect()->route('evaluation_types.evaluation_type.index')
                ->with('success_message', 'Evaluation Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified evaluation type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $evaluationType = EvaluationType::findOrFail($id);

        return view('evaluation.evaluation_types.show', compact('evaluationType'));
    }

    /**
     * Show the form for editing the specified evaluation type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $evaluationType = EvaluationType::findOrFail($id);
        

        return view('evaluation.evaluation_types.edit', compact('evaluationType'));
    }

    /**
     * Update the specified evaluation type in the storage.
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
            
            $evaluationType = EvaluationType::findOrFail($id);
            $evaluationType->update($data);

            return redirect()->route('evaluation_types.evaluation_type.index')
                ->with('success_message', 'Evaluation Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified evaluation type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $evaluationType = EvaluationType::findOrFail($id);
            $evaluationType->delete();

            return redirect()->route('evaluation_types.evaluation_type.index')
                ->with('success_message', 'Evaluation Type was successfully deleted.');
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
                'name' => 'required|string|min:1|max:255',
                'description' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
