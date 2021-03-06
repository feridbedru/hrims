<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\SystemException;
use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DB;
use Exception;

class TemplatesController extends Controller
{

    /**
     * Display a listing of the templates.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $templates = Template::with('languages','types')->paginate(25);
           
        return view('settings.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = Language::pluck('name', 'id')->all();
        $templateTypes = TemplateType::pluck('name', 'id')->all();

        return view('settings.templates.create', compact('languages', 'templateTypes'));
    }

    /**
     * Store a new template in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            Template::create($data);

            return redirect()->route('templates.template.index')
                ->with('success_message', 'Template was successfully added.');
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
     * Display the specified template.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $template = Template::with('languages','types')->findOrFail($id);

        return view('settings.templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified template.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $template = Template::findOrFail($id);
        $languages = Language::pluck('name', 'id')->all();
        $templateTypes = TemplateType::pluck('name', 'id')->all();

        return view('settings.templates.edit', compact('template', 'languages', 'templateTypes'));
    }

    /**
     * Update the specified template in the storage.
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

            $template = Template::findOrFail($id);
            $template->update($data);

            return redirect()->route('templates.template.index')
                ->with('success_message', 'Template was successfully updated.');
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
     * Remove the specified template from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $template = Template::findOrFail($id);
            $delete = $template->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Template deleted successfully";
            } else {
                $success = false;
                $message = "Template not found";
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
            'title' => 'required|string|min:1|max:255',
            'body' => 'required|string|min:1',
            'language' => 'required|numeric|min:0|max:4294967295',
            'template_type' => 'required',
            'is_active' => 'boolean',
            'code' => 'required|string|min:1',
        ];

        $data = $request->validate($rules);

        $data['is_active'] = $request->has('is_active');

        return $data;
    }
}
