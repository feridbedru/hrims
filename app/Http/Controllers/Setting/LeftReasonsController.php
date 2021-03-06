<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\LeftReason;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class LeftReasonsController extends Controller
{

    /**
     * Display a listing of the left reasons.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $leftReasons = LeftReason::paginate(25);

        return view('settings.left_reasons.index', compact('leftReasons'));
    }

    /**
     * Show the form for creating a new left reason.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.left_reasons.create');
    }

    /**
     * Store a new left reason in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            LeftReason::create($data);

            return redirect()->route('left_reasons.left_reason.index')
                ->with('success_message', 'Left Reason was successfully added.');
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
     * Show the form for editing the specified left reason.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $leftReason = LeftReason::findOrFail($id);

        return view('settings.left_reasons.edit', compact('leftReason'));
    }

    /**
     * Update the specified left reason in the storage.
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

            $leftReason = LeftReason::findOrFail($id);
            $leftReason->update($data);

            return redirect()->route('left_reasons.left_reason.index')
                ->with('success_message', 'Left Reason was successfully updated.');
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
     * Remove the specified left reason from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $leftReason = LeftReason::findOrFail($id);
            $delete = $leftReason->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Left Reason deleted successfully";
            } else {
                $success = false;
                $message = "Left Reason not found";
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
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
