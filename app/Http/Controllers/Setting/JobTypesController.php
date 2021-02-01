<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;
use Exception;

class JobTypesController extends Controller
{

    /**
     * Display a listing of the job types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $jobTypes = JobType::paginate(25);

        return view('settings.job_types.index', compact('jobTypes'));
    }

    /**
     * Show the form for creating a new job type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.job_types.create');
    }

    /**
     * Store a new job type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            JobType::create($data);

            return redirect()->route('job_types.job_type.index')
                ->with('success_message', 'Job Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified job type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $jobType = JobType::findOrFail($id);
        

        return view('settings.job_types.edit', compact('jobType'));
    }

    /**
     * Update the specified job type in the storage.
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
            
            $jobType = JobType::findOrFail($id);
            $jobType->update($data);

            return redirect()->route('job_types.job_type.index')
                ->with('success_message', 'Job Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified job type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $jobType = JobType::findOrFail($id);
            $jobType->delete();

            return redirect()->route('job_types.job_type.index')
                ->with('success_message', 'Job Type was successfully deleted.');
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
