<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class JobCategoriesController extends Controller
{

    /**
     * Display a listing of the job categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jobCategories = JobCategory::paginate(25);

        return view('settings.job_categories.index', compact('jobCategories'));
    }

    /**
     * Show the form for creating a new job category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.job_categories.create');
    }

    /**
     * Store a new job category in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            JobCategory::create($data);

            return redirect()->route('job_categories.job_category.index')
                ->with('success_message', 'Job Category was successfully added.');
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
     * Show the form for editing the specified job category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $jobCategory = JobCategory::findOrFail($id);

        return view('settings.job_categories.edit', compact('jobCategory'));
    }

    /**
     * Update the specified job category in the storage.
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

            $jobCategory = JobCategory::findOrFail($id);
            $jobCategory->update($data);

            return redirect()->route('job_categories.job_category.index')
                ->with('success_message', 'Job Category was successfully updated.');
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
     * Remove the specified job category from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $jobCategory = JobCategory::findOrFail($id);
            $delete = $jobCategory->delete();

            if ($delete == 1) {
                $success = true;
                $message = "Job Category deleted successfully";
            } else {
                $success = false;
                $message = "Job Category not found";
            }
            //  return response
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
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
            'description' => 'string|min:1|max:1000|nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
