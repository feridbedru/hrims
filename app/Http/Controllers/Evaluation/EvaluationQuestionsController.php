<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\EvaluationQuestion;
use Illuminate\Http\Request;
use Exception;

class EvaluationQuestionsController extends Controller
{

    /**
     * Display a listing of the evaluation questions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $evaluationQuestions = EvaluationQuestion::with('evaluation')->paginate(25);

        return view('evaluation.evaluation_questions.index', compact('evaluationQuestions'));
    }

    /**
     * Show the form for creating a new evaluation question.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $evaluations = Evaluation::pluck('title','id')->all();
        
        return view('evaluation.evaluation_questions.create', compact('evaluations'));
    }

    /**
     * Store a new evaluation question in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            EvaluationQuestion::create($data);

            return redirect()->route('evaluation_questions.evaluation_question.index')
                ->with('success_message', 'Evaluation Question was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified evaluation question.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $evaluationQuestion = EvaluationQuestion::with('evaluation')->findOrFail($id);

        return view('evaluation.evaluation_questions.show', compact('evaluationQuestion'));
    }

    /**
     * Show the form for editing the specified evaluation question.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $evaluationQuestion = EvaluationQuestion::findOrFail($id);
        $evaluations = Evaluation::pluck('title','id')->all();

        return view('evaluation.evaluation_questions.edit', compact('evaluationQuestion','evaluations'));
    }

    /**
     * Update the specified evaluation question in the storage.
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
            
            $evaluationQuestion = EvaluationQuestion::findOrFail($id);
            $evaluationQuestion->update($data);

            return redirect()->route('evaluation_questions.evaluation_question.index')
                ->with('success_message', 'Evaluation Question was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified evaluation question from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $evaluationQuestion = EvaluationQuestion::findOrFail($id);
            $evaluationQuestion->delete();

            return redirect()->route('evaluation_questions.evaluation_question.index')
                ->with('success_message', 'Evaluation Question was successfully deleted.');
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
                'evaluation_id' => 'required',
                'criteria' => 'required|string|min:1',
                'weight' => 'required',
                'order' => 'required',
                'status' => 'required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
