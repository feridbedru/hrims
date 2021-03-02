<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\SystemException;
use App\Models\TemplateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class TemplateTypesController extends Controller
{

    /**
     * Display a listing of the template types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $templateTypes = TemplateType::paginate(25);

        return view('settings.template_types.index', compact('templateTypes'));
    }

    /**
     * Show the form for creating a new template type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.template_types.create');
    }

    /**
     * Store a new template type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            TemplateType::create($data);

            return redirect()->route('template_types.template_type.index')
                ->with('success_message', 'Template Type was successfully added.');
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
     * Show the form for editing the specified template type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $templateType = TemplateType::findOrFail($id);

        return view('settings.template_types.edit', compact('templateType'));
    }

    /**
     * Update the specified template type in the storage.
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

            $templateType = TemplateType::findOrFail($id);
            $templateType->update($data);

            return redirect()->route('template_types.template_type.index')
                ->with('success_message', 'Template Type was successfully updated.');
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
     * Remove the specified template type from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $templateType = TemplateType::findOrFail($id);
            $delete = $templateType->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Template Type deleted successfully";
            } else {
                $success = false;
                $message = "Template Type not found";
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
