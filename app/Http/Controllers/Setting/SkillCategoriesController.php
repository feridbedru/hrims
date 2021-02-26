<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Exception;

class SkillCategoriesController extends Controller
{

    /**
     * Display a listing of the skill categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $skillCategories = SkillCategory::paginate(25);

        return view('settings.skill_categories.index', compact('skillCategories'));
    }

    /**
     * Show the form for creating a new skill category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.skill_categories.create');
    }

    /**
     * Store a new skill category in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SkillCategory::create($data);

            return redirect()->route('skill_categories.skill_category.index')
                ->with('success_message', 'Skill Category was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified skill category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $skillCategory = SkillCategory::findOrFail($id);
        

        return view('settings.skill_categories.edit', compact('skillCategory'));
    }

    /**
     * Update the specified skill category in the storage.
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
            
            $skillCategory = SkillCategory::findOrFail($id);
            $skillCategory->update($data);

            return redirect()->route('skill_categories.skill_category.index')
                ->with('success_message', 'Skill Category was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified skill category from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $skillCategory = SkillCategory::findOrFail($id);
            $delete = $skillCategory->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Skill Category deleted successfully";
            } else {
                $success = false;
                $message = "Skill Category not found";
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
