<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\ExperienceType;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class ExperienceTypesController extends Controller
{

    /**
     * Display a listing of the experience types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $experienceTypes = ExperienceType::paginate(25);

        return view('settings.experience_types.index', compact('experienceTypes'));
    }

    /**
     * Show the form for creating a new experience type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.experience_types.create');
    }

    /**
     * Store a new experience type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            ExperienceType::create($data);

            return redirect()->route('experience_types.experience_type.index')
                ->with('success_message', 'Experience Type was successfully added.');
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
     * Show the form for editing the specified experience type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $experienceType = ExperienceType::findOrFail($id);

        return view('settings.experience_types.edit', compact('experienceType'));
    }

    /**
     * Update the specified experience type in the storage.
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

            $experienceType = ExperienceType::findOrFail($id);
            $experienceType->update($data);

            return redirect()->route('experience_types.experience_type.index')
                ->with('success_message', 'Experience Type was successfully updated.');
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
     * Remove the specified experience type from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $experienceType = ExperienceType::findOrFail($id);
            $delete = $experienceType->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Experience Type deleted successfully";
            } else {
                $success = false;
                $message = "Experience Type not found";
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
