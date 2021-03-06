<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\EmployeeStatus;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeStatusesController extends Controller
{

    /**
     * Display a listing of the employee statuses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeStatuses = EmployeeStatus::paginate(25);

        return view('settings.employee_statuses.index', compact('employeeStatuses'));
    }

    /**
     * Show the form for creating a new employee status.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.employee_statuses.create');
    }

    /**
     * Store a new employee status in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            EmployeeStatus::create($data);

            return redirect()->route('employee_statuses.employee_status.index')
                ->with('success_message', 'Employee Status was successfully added.');
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
     * Show the form for editing the specified employee status.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeStatus = EmployeeStatus::findOrFail($id);

        return view('settings.employee_statuses.edit', compact('employeeStatus'));
    }

    /**
     * Update the specified employee status in the storage.
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

            $employeeStatus = EmployeeStatus::findOrFail($id);
            $employeeStatus->update($data);

            return redirect()->route('employee_statuses.employee_status.index')
                ->with('success_message', 'Employee Status was successfully updated.');
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
     * Remove the specified employee status from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $employeeStatus = EmployeeStatus::findOrFail($id);
            $delete = $employeeStatus->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Employee Status deleted successfully";
            } else {
                $success = false;
                $message = "Employee Status not found";
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
