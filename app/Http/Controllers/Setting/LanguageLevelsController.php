<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\LanguageLevel;
use Illuminate\Http\Request;
use Exception;

class LanguageLevelsController extends Controller
{

    /**
     * Display a listing of the language levels.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $languageLevels = LanguageLevel::paginate(25);

        return view('settings.language_levels.index', compact('languageLevels'));
    }

    /**
     * Show the form for creating a new language level.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.language_levels.create');
    }

    /**
     * Store a new language level in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            LanguageLevel::create($data);

            return redirect()->route('language_levels.language_level.index')
                ->with('success_message', 'Language Level was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified language level.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $languageLevel = LanguageLevel::findOrFail($id);
        

        return view('settings.language_levels.edit', compact('languageLevel'));
    }

    /**
     * Update the specified language level in the storage.
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
            
            $languageLevel = LanguageLevel::findOrFail($id);
            $languageLevel->update($data);

            return redirect()->route('language_levels.language_level.index')
                ->with('success_message', 'Language Level was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified language level from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $languageLevel = LanguageLevel::findOrFail($id);
            $delete = $languageLevel->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Language Level deleted successfully";
            } else {
                $success = false;
                $message = "Language Level not found";
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
            'description' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
