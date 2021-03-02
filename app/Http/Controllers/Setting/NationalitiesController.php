<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Nationality;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class NationalitiesController extends Controller
{

    /**
     * Display a listing of the nationalities.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nationalities = Nationality::paginate(25);

        return view('settings.nationalities.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new nationality.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.nationalities.create');
    }

    /**
     * Store a new nationality in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            Nationality::create($data);

            return redirect()->route('nationalities.nationality.index')
                ->with('success_message', 'Nationality was successfully added.');
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
     * Show the form for editing the specified nationality.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $nationality = Nationality::findOrFail($id);

        return view('settings.nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified nationality in the storage.
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

            $nationality = Nationality::findOrFail($id);
            $nationality->update($data);

            return redirect()->route('nationalities.nationality.index')
                ->with('success_message', 'Nationality was successfully updated.');
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
     * Remove the specified nationality from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $nationality = Nationality::findOrFail($id);
            $delete = $nationality->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Nationality deleted successfully";
            } else {
                $success = false;
                $message = "Nationality not found";
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
            'code' => 'required|string|min:1',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
