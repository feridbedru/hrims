<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\GPAScale;
use Illuminate\Http\Request;
use Exception;

class GPAScalesController extends Controller
{

    /**
     * Display a listing of the g p a scales.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $gPAScales = GPAScale::paginate(25);

        return view('settings.gpa_scales.index', compact('gPAScales'));
    }

    /**
     * Show the form for creating a new g p a scale.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.gpa_scales.create');
    }

    /**
     * Store a new g p a scale in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            GPAScale::create($data);

            return redirect()->route('gpa_scales.gpa_scale.index')
                ->with('success_message', 'GPA Scale was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified g p a scale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $gPAScale = GPAScale::findOrFail($id);
        

        return view('settings.gpa_scales.edit', compact('gPAScale'));
    }

    /**
     * Update the specified g p a scale in the storage.
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
            
            $gPAScale = GPAScale::findOrFail($id);
            $gPAScale->update($data);

            return redirect()->route('gpa_scales.gpa_scale.index')
                ->with('success_message', 'GPA Scale was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified g p a scale from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $gPAScale = GPAScale::findOrFail($id);
            $delete = $gPAScale->delete();
            if ($delete == 1) {
                $success = true;
                $message = "GPA Scale deleted successfully";
            } else {
                $success = false;
                $message = "GPA Scale not found";
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
