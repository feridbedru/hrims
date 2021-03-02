<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\EducationalInstitute;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class EducationalInstitutesController extends Controller
{

    /**
     * Display a listing of the educational institutes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $educationalInstitutes = EducationalInstitute::paginate(25);

        return view('settings.educational_institutes.index', compact('educationalInstitutes'));
    }

    /**
     * Show the form for creating a new educational institute.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.educational_institutes.create');
    }

    /**
     * Store a new educational institute in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            EducationalInstitute::create($data);

            return redirect()->route('educational_institutes.educational_institute.index')
                ->with('success_message', 'Educational Institute was successfully added.');
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
     * Show the form for editing the specified educational institute.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $educationalInstitute = EducationalInstitute::findOrFail($id);

        return view('settings.educational_institutes.edit', compact('educationalInstitute'));
    }

    /**
     * Update the specified educational institute in the storage.
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

            $educationalInstitute = EducationalInstitute::findOrFail($id);
            $educationalInstitute->update($data);

            return redirect()->route('educational_institutes.educational_institute.index')
                ->with('success_message', 'Educational Institute was successfully updated.');
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
     * Remove the specified educational institute from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $educationalInstitute = EducationalInstitute::findOrFail($id);
            $delete = $educationalInstitute->delete();

            if ($delete == 1) {
                $success = true;
                $message = "Educational Institute deleted successfully";
            } else {
                $success = false;
                $message = "Educational Institute not found";
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
            'abbreviation' => 'string|min:1|nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
