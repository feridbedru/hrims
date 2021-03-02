<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\CommitmentFor;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class CommitmentForsController extends Controller
{

    /**
     * Display a listing of the commitment fors.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $commitmentFors = CommitmentFor::paginate(25);

        return view('settings.commitment_fors.index', compact('commitmentFors'));
    }

    /**
     * Show the form for creating a new commitment for.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.commitment_fors.create');
    }

    /**
     * Store a new commitment for in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            CommitmentFor::create($data);

            return redirect()->route('commitment_fors.commitment_for.index')
                ->with('success_message', 'Commitment For was successfully added.');
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
     * Show the form for editing the specified commitment for.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $commitmentFor = CommitmentFor::findOrFail($id);

        return view('settings.commitment_fors.edit', compact('commitmentFor'));
    }

    /**
     * Update the specified commitment for in the storage.
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

            $commitmentFor = CommitmentFor::findOrFail($id);
            $commitmentFor->update($data);

            return redirect()->route('commitment_fors.commitment_for.index')
                ->with('success_message', 'Commitment For was successfully updated.');
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
     * Remove the specified commitment for from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $commitmentFor = CommitmentFor::findOrFail($id);
            $delete = $commitmentFor->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Commitment For deleted successfully";
            } else {
                $success = false;
                $message = "Commitment For not found";
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
