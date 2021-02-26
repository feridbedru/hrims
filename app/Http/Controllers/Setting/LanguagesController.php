<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Exception;

class LanguagesController extends Controller
{

    /**
     * Display a listing of the languages.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languages = Language::paginate(25);

        return view('settings.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new language.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.languages.create');
    }

    /**
     * Store a new language in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Language::create($data);

            return redirect()->route('languages.language.index')
                ->with('success_message', 'Language was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        

        return view('settings.languages.edit', compact('language'));
    }

    /**
     * Update the specified language in the storage.
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
            
            $language = Language::findOrFail($id);
            $language->update($data);

            return redirect()->route('languages.language.index')
                ->with('success_message', 'Language was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified language from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $language = Language::findOrFail($id);
            $delete = $language->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Language was deleted successfully";
            } else {
                $success = false;
                $message = "Language was not found";
            }
                    //  return response
                    return response()->json([
                        'success' => $success,
                        'message' => $message,
                    ]);
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
                'name' => 'required|string|min:1|max:255',
            'code' => 'string|min:1|nullable',
            'is_default' => 'boolean', 
        ];
        
        $data = $request->validate($rules);

        $data['is_default'] = $request->has('is_default');

        return $data;
    }

}
