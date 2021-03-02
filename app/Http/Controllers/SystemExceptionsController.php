<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Exception;

class SystemExceptionsController extends Controller
{

    /**
     * Display a listing of the system exceptions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $systemExceptions = SystemException::paginate(25);

        return view('system_exceptions.index', compact('systemExceptions'));
    }

    /**
     * Display the specified system exception.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $systemException = SystemException::findOrFail($id);

        return view('system_exceptions.show', compact('systemException'));
    }

    /**
     * Show the form for editing the specified system exception.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $systemException = SystemException::findOrFail($id);


        return view('system_exceptions.edit', compact('systemException'));
    }

    /**
     * Update the specified system exception in the storage.
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

            $systemException = SystemException::findOrFail($id);
            $systemException->update($data);

            return redirect()->route('system_exceptions.system_exception.index')
                ->with('success_message', 'System Exception was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified system exception from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $systemException = SystemException::findOrFail($id);
            $systemException->delete();

            return redirect()->route('system_exceptions.system_exception.index')
                ->with('success_message', 'System Exception was successfully deleted.');
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
            'title' => 'string|min:1|max:255|nullable',
            'function' => 'string|min:1|nullable',
            'path' => 'string|min:1|nullable',
            'request' => 'string|min:1|nullable',
            'message' => 'string|nullable',
            'status' => 'string|min:1|nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
