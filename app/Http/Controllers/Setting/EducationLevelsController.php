<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class EducationLevelsController extends Controller
{

    /**
     * Display a listing of the education levels.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $educationLevels = EducationLevel::paginate(25);

        return view('settings.education_levels.index', compact('educationLevels'));
    }

    /**
     * Show the form for creating a new education level.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.education_levels.create');
    }

    /**
     * Store a new education level in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            EducationLevel::create($data);

            return redirect()->route('education_levels.education_level.index')
                ->with('success_message', 'Education Level was successfully added.');
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
     * Show the form for editing the specified education level.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $educationLevel = EducationLevel::findOrFail($id);

        return view('settings.education_levels.edit', compact('educationLevel'));
    }

    /**
     * Update the specified education level in the storage.
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

            $educationLevel = EducationLevel::findOrFail($id);
            $educationLevel->update($data);

            return redirect()->route('education_levels.education_level.index')
                ->with('success_message', 'Education Level was successfully updated.');
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
     * Remove the specified education level from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $educationLevel = EducationLevel::findOrFail($id);
            $delete = $educationLevel->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Education Level deleted successfully";
            } else {
                $success = false;
                $message = "Education Level not found";
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
