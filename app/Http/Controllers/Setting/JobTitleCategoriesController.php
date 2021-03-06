<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\JobTitleCategory;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class JobTitleCategoriesController extends Controller
{

    /**
     * Display a listing of the job title categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jobTitleCategories = JobTitleCategory::with('parents')->paginate(25);

        return view('settings.job_title_categories.index', compact('jobTitleCategories'));
    }

    /**
     * Show the form for creating a new job title category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $jobTitleCategories = JobTitleCategory::pluck('name', 'id')->all();

        return view('settings.job_title_categories.create', compact('jobTitleCategories'));
    }

    /**
     * Store a new job title category in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            JobTitleCategory::create($data);

            return redirect()->route('job_title_categories.job_title_category.index')
                ->with('success_message', 'Job Title Category was successfully added.');
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
     * Show the form for editing the specified job title category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $jobTitleCategory = JobTitleCategory::findOrFail($id);
        $jobTitleCategories = JobTitleCategory::pluck('name', 'id')->all();

        return view('settings.job_title_categories.edit', compact('jobTitleCategory', 'jobTitleCategories'));
    }

    /**
     * Update the specified job title category in the storage.
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

            $jobTitleCategory = JobTitleCategory::findOrFail($id);
            $jobTitleCategory->update($data);

            return redirect()->route('job_title_categories.job_title_category.index')
                ->with('success_message', 'Job Title Category was successfully updated.');
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
     * Remove the specified job title category from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $jobTitleCategory = JobTitleCategory::findOrFail($id);
            $delete = $jobTitleCategory->delete();

            if ($delete == 1) {
                $success = true;
                $message = "Job Title Category deleted successfully";
            } else {
                $success = false;
                $message = "Job Title Category not found";
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
            'name' => 'string|min:1|max:255|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'parent' => 'nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
