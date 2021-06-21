<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Exception;

class LeaveTypesController extends Controller
{

    /**
     * Display a listing of the leave types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $leaveTypes = LeaveType::with('jobtype')->paginate(25);

        return view('leave.leave_types.index', compact('leaveTypes'));
    }

    /**
     * Show the form for creating a new leave type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $jobTypes = JobType::pluck('name', 'id')->all();

        return view('leave.leave_types.create', compact('jobTypes'));
    }

    /**
     * Store a new leave type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            LeaveType::create($data);

            return redirect()->route('leave_types.leave_type.index')
                ->with('success_message', 'Leave Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified leave type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $leaveType = LeaveType::with('jobtype')->findOrFail($id);

        return view('leave.leave_types.show', compact('leaveType'));
    }

    /**
     * Show the form for editing the specified leave type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $jobTypes = JobType::pluck('name', 'id')->all();

        return view('leave.leave_types.edit', compact('leaveType', 'jobTypes'));
    }

    /**
     * Update the specified leave type in the storage.
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

            $leaveType = LeaveType::findOrFail($id);
            $leaveType->update($data);

            return redirect()->route('leave_types.leave_type.index')
                ->with('success_message', 'Leave Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified leave type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $leaveType = LeaveType::findOrFail($id);
            $leaveType->delete();

            return redirect()->route('leave_types.leave_type.index')
                ->with('success_message', 'Leave Type was successfully deleted.');
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
            'name' => 'string|min:1|max:255|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'job_type_id' => 'required',
            'initial' => 'string|min:1|nullable|numeric',
            'maximum' => 'string|min:1|nullable|numeric',
            'male' => 'string|min:1|nullable|numeric',
            'female' => 'required|string|min:1|numeric',
            'includes_offdays' => 'boolean|nullable',
            'is_transferable' => 'boolean|nullable',
            'pre_post' => 'string|min:1|nullable',
            'is_active' => 'boolean|nullable',
        ];

        $data = $request->validate($rules);

        $data['includes_offdays'] = $request->has('includes_offdays');
        $data['is_transferable'] = $request->has('is_transferable');
        $data['is_active'] = $request->has('is_active');

        return $data;
    }
}
